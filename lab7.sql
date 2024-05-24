drop table persoane;

CREATE TABLE persoane (
  id INT NOT NULL PRIMARY KEY,
  nume VARCHAR2(15) NOT NULL,
  prenume VARCHAR2(30) NOT NULL,
  email VARCHAR2(30) NOT NULL,
  telefon NUMBER(10)
  )
  /
  

CREATE OR REPLACE PROCEDURE LoadPersoane (
  p_FileDir  IN VARCHAR2,
  p_FileName IN VARCHAR2,
  p_TotalInserted IN OUT NUMBER) AS

  v_fisier UTL_FILE.FILE_TYPE;
  v_sir  VARCHAR2(100);  
  v_nume persoane.nume%TYPE;
  v_prenume persoane.prenume%TYPE;
  v_email persoane.email%TYPE;
  v_telefon persoane.telefon%TYPE;
   student_existent EXCEPTION;
  PRAGMA EXCEPTION_INIT(student_existent, -20001);
  counter  INTEGER;

  v_FirstComma NUMBER;
  v_SecondComma NUMBER;
  v_ThirdComma NUMBER;
BEGIN
  v_fisier := UTL_FILE.FOPEN(p_FileDir, p_FileName, 'r');

  p_TotalInserted := 0;

  LOOP
    BEGIN
      UTL_FILE.GET_LINE(v_fisier, v_sir);
    EXCEPTION
      WHEN NO_DATA_FOUND THEN
        EXIT;
    END;

    v_FirstComma := INSTR(v_sir, ',', 1, 1);
    v_SecondComma := INSTR(v_sir, ',', 1, 2);
    v_ThirdComma := INSTR(v_sir, ',', 1, 3);
    
    v_nume := SUBSTR(v_sir, 1, v_FirstComma - 1);
    v_prenume := SUBSTR(v_sir, v_FirstComma + 1,
                         v_SecondComma - v_FirstComma - 1);
    v_email := SUBSTR(v_sir, v_SecondComma + 1,
                         v_ThirdComma - v_SecondComma - 1);
    v_telefon := SUBSTR(v_sir, v_ThirdComma + 1);
    
    counter := 0;
    select count(*) into counter from persoane where nume = v_nume and prenume = v_prenume;
    if counter != 0 then
    raise student_existent;
    end if;
    
    INSERT INTO persoane (ID, nume, prenume, email, telefon) VALUES (p_TotalInserted + 1, v_nume, v_prenume, v_email, v_telefon);
    
    p_TotalInserted := p_TotalInserted + 1;
      
  END LOOP;

  UTL_FILE.FCLOSE(v_fisier);
  EXCEPTION
  WHEN student_existent THEN
  raise_application_error (-20001,'Studentul: ' || v_nume || ' ' || v_prenume || ' exista deja in baza de date.');
  END LoadPersoane;
  
  set serveroutput on;
  DECLARE
  p_dir varchar(10) := 'MYDIR';
  p_file varchar(20) := 'myfile.txt';
  p_total number;
  BEGIN
 LoadPersoane(p_dir,p_file,p_total);
  END;