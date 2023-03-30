SELECT last_name, first_name, salary+100
FROM T_EMPLOYEE
WHERE manager_id = (SELECT employee_id
		    FROM T_EMPLOYEE
		    WHERE manager_id IS NULL);
