DROP TABLE IF EXISTS gb_grade;
DROP TABLE IF EXISTS gb_student;

CREATE TABLE gb_student (
  gb_student_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gb_student_first VARCHAR(255),
  gb_student_last VARCHAR(255)
);

INSERT INTO gb_student (gb_student_id,gb_student_first,gb_student_last) VALUES
  (1,'John','Smith'),
  (2,'Jane','Doe'),
  (3,'Henry','Miller'),
  (4,'Mary','Jones');

CREATE TABLE gb_grade (
  gb_grade_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gb_grade_assignment VARCHAR(255),
  gb_grade_letter VARCHAR(2), 
  gb_student_id INT NOT NULL,
  FOREIGN KEY (gb_student_id) REFERENCES gb_student(gb_student_id)
);
   
INSERT INTO gb_grade (gb_grade_assignment,gb_grade_letter,gb_student_id) VALUES
  ('History','B',1),('English','C+',1),('Math','A-',1),('Science','C',1),('Religion','B+',1),
  ('History','D',2),('English','C-',2),('Math','F',2),('Science','C+',2),('Religion','D-',2),
  ('History','C',3),('English','B+',3),('Math','C+',3),('Science','B-',3),('Religion','B',3),
  ('History','A',4),('English','A',4),('Math','A',4),('Science','A-',4),('Religion','A',4);
