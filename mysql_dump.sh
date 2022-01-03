#!/bin/sh
# This script will help to create MySQL auto backup on every hour
# Database Details goes here
db_host="localhost"
db_name="pos"
db_username="root"
db_password=''
backup_location=/storage/app/backup
today=`date +%Y-%m-%d`
sql_file=$backup_location/$today/$db_name-`date +%H%M`.sql
tar_file=$backup_location/$today/$db_name-`date +%H%M`.tar.gz
if [ ! -d $backup_location/$today ]
then
mkdir -p $backup_location/$today
/usr/bin/mysqldump -h $db_host -u $db_username -p$db_password $db_name > $sql_file
tar zcf $tar_file $sql_file
rm $sql_file
else
/usr/bin/mysqldump -h $db_host -u $db_username -p$db_password $db_name > $sql_file
tar zcf $tar_file $sql_file
rm $sql_file
fi