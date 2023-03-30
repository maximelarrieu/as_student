-- Select rows from a Table or View 'T_employee' in schema 'SchemaName'
SELECT employee_id, last_name, first_name, (salary + 100) FROM T_employee
WHERE 	employee_id = (SELECT employee_id /* add search conditions here + request*/
                        FROM T_reservation); /* end request*/
