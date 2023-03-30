SELECT pa.pass_name, COUNT(cust.customer_id)
FROM T_PASS pa JOIN T_CUSTOMER cust
ON pa.pass_id = cust.pass_id
GROUP BY pa.pass_name
ORDER BY COUNT(cust.customer_id) DESC;
