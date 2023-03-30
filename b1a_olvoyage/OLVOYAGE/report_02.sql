SELECT cust.last_name, cust.first_name, p.pass_name
FROM T_CUSTOMER cust JOIN T_PASS p
ON cust.pass_id = p.pass_id
AND  cust.last_name != p.pass_name;
