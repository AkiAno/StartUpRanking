SELECT `metric_values`.*, 
    max_lower_values.`value` AS max_lower_value,
    min_higher_values.`value` AS min_higher_value
FROM `metric_values`
LEFT JOIN (
    SELECT `metric_values`.`account_id`, `value`
    FROM `metric_values`
    RIGHT JOIN (
        SELECT `metric_values`.`account_id`, MAX(`date`) AS max_date
        FROM `metric_values`
        WHERE `date` < '2018-10-01'
        GROUP BY `account_id`
    ) max_lower_dates
        ON `metric_values`.`account_id` = max_lower_dates.`account_id`
        AND `metric_values`.`date` = max_lower_dates.`max_date`    
) max_lower_values
    ON `metric_values`.`account_id` = max_lower_values.`account_id`
LEFT JOIN (
    SELECT `metric_values`.`account_id`, `value`
    FROM `metric_values`
    RIGHT JOIN (
        SELECT `account_id`, MIN(`date`) AS min_date
        FROM `metric_values`
        WHERE `date` > '2018-11-15'
        GROUP BY `metric_values`.`account_id`
    ) min_higher_dates
        ON `metric_values`.`account_id` = min_higher_dates.`account_id`
        AND `metric_values`.`date` = min_higher_dates.`min_date`    
) min_higher_values
    ON `metric_values`.`account_id` = min_higher_values.`account_id`
WHERE max_lower_values.value is not null and min_higher_values.value is not null