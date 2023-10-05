/* Trigger  for INSERT */
CREATE TRIGGER HistoryTableInsert AFTER INSERT ON reserva FOR EACH ROW BEGIN
   DECLARE N DATETIME;
   SET N = now();
   INSERT INTO HistoryTable (res_cod, res_data, res_horario, usu_cod, rec_cod, StartDate, EndDate)
   VALUES (NEW.res_cod, NEW.res_data, NEW.res_horario, NEW.usu_cod, NEW.rec_cod, N, NULL);
END;
/* Trigger for DELETE */
CREATE TRIGGER HistoryTableDelete AFTER DELETE ON reserva FOR EACH ROW BEGIN
   DECLARE N DATETIME;
   SET N = now();
   UPDATE HistoryTable
      SET EndDate = N
    WHERE res_cod = OLD.res_cod
      AND EndDate IS NULL;
END;
/* Trigger for UPDATE */
CREATE TRIGGER HistoryTableUpdate AFTER UPDATE ON reserva FOR EACH ROW BEGIN
   DECLARE N DATETIME;
   SET N = now();
   UPDATE HistoryTable
      SET EndDate = N
    WHERE res_cod = OLD.res_cod
      AND EndDate IS NULL;
   INSERT INTO HistoryTable (res_cod, res_data, res_horario, usu_cod, rec_cod, StartDate, EndDate)
   VALUES (NEW.res_cod, NEW.res_data, NEW.res_horario, NEW.usu_cod, NEW.rec_cod, N, NULL);
END;