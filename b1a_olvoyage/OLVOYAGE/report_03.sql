SELECT emp.last_name, emp.first_name, res.buyer_id, res.reservation_id, res.creation_date
FROM T_EMPLOYEE emp JOIN T_RESERVATION res
ON emp.employee_id = res.employee_id
WHERE res.creation_date = (SELECT MIN(creation_date) FROM T_RESERVATION);
