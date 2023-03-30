SELECT e.last_name, e.first_name, r.reservation_id
FROM T_EMPLOYEE e
JOIN T_RESERVATION r
ON e.employee_id = r.employee_id;
