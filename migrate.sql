UPDATE expenses SET ex_proid = '20' WHERE ex_proid = '14' OR ex_proid = '25' OR ex_proid = '26'; 
UPDATE project_resource SET prore_proid = '20' WHERE prore_proid = '14' OR prore_proid = '25' OR prore_proid = '26';
UPDATE timesheet SET tm_proid = '20' WHERE tm_proid = '14' OR tm_proid = '25' OR tm_proid = '26';

DELETE FROM expenses WHERE ex_head = 'Invoice'