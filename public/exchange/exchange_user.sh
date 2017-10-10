#!/bin/bash

START=$(date +%s)

USER="root" # MySQL User
PASSWD="170270" # MySQL password
BASE="sint_odessa"

date_old=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT exchange as '' FROM exchanges WHERE id = 1") # Date old exchange

delimiter=','
quotes='"'

table_user='users'
table_user_profile='user_profiles'
table_order='orders'

#export_user='/var/www/sint.odessa/public/exchange/files/1c_user.csv'
export_order='/var/www/sint.odessa/public/exchange/files/1c_order.csv'
import_user='/var/www/sint.odessa/public/exchange/files/users1C.csv'
import_order='/var/www/sint.odessa/public/exchange/files/site_order.csv'

export_patch='/var/www/sint.odessa/public/exchange/export'
import_patch='/var/www/sint.odessa/public/exchange/import'

export_user=$export_patch/user$(date +"%Y%m%d%H%M").csv

 
echo $tt
# Export to 1C
#mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_user}
#mysql -u$USER -p$PASSWD -D$BASE -e "SELECT id,user_id,1c_id,1cuser_id,type_order_id,type_client_id,client_name,user_company,phone,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,type_payment_id,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,comment,status_id,created_at,updated_at FROM ${table_order} WHERE created_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_order}


for i in ${import_patch}/*.csv
do
  echo $i

	readarray array < $i
	for ((a=1; a < ${#array[*]}; a++))
do
	id_str=$(echo ${array[$a]} | awk -F ${delimiter} '{print $1}' | sed 's/"//g') # ID
			name=$(echo ${array[$a]} | awk -F ${delimiter} '{print $26}' | sed 's/"//g')
			email=$(echo ${array[$a]} | awk -F ${delimiter} '{print $27}' | sed 's/"//g')
			c_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $2}' | sed 's/"//g')
            type_client_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $3}' | sed 's/"//g')
            type_payment_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $4}' | sed 's/"//g')
            client_name=$(echo ${array[$a]} | awk -F ${delimiter} '{print $5}' | sed 's/"//g')
            delivery_town=$(echo ${array[$a]} | awk -F ${delimiter} '{print $6}' | sed 's/"//g')
            delivery_street=$(echo ${array[$a]} | awk -F ${delimiter} '{print $7}' | sed 's/"//g')
            delivery_house=$(echo ${array[$a]} | awk -F ${delimiter} '{print $8}' | sed 's/"//g')
            delivery_house_block=$(echo ${array[$a]} | awk -F ${delimiter} '{print $9}' | sed 's/"//g')
            delivery_office=$(echo ${array[$a]} | awk -F ${delimiter} '{print $10}' | sed 's/"//g')
            phone=$(echo ${array[$a]} | awk -F ${delimiter} '{print $11}' | sed 's/"//g')
            user_company=$(echo ${array[$a]} | awk -F ${delimiter} '{print $12}' | sed 's/"//g')
            company_full=$(echo ${array[$a]} | awk -F ${delimiter} '{print $13}' | sed 's/"//g')
            edrpou=$(echo ${array[$a]} | awk -F ${delimiter} '{print $14}' | sed 's/"//g')
            inn=$(echo ${array[$a]} | awk -F ${delimiter} '{print $15}' | sed 's/"//g')
            code_index=$(echo ${array[$a]} | awk -F ${delimiter} '{print $16}' | sed 's/"//g')
            region=$(echo ${array[$a]} | awk -F ${delimiter} '{print $17}' | sed 's/"//g')
            area=$(echo ${array[$a]} | awk -F ${delimiter} '{print $18}' | sed 's/"//g')
            city=$(echo ${array[$a]} | awk -F ${delimiter} '{print $19}' | sed 's/"//g')
            street=$(echo ${array[$a]} | awk -F ${delimiter} '{print $20}' | sed 's/"//g')
            house=$(echo ${array[$a]} | awk -F ${delimiter} '{print $21}' | sed 's/"//g')
            house_block=$(echo ${array[$a]} | awk -F ${delimiter} '{print $22}' | sed 's/"//g')
            office=$(echo ${array[$a]} | awk -F ${delimiter} '{print $23}' | sed 's/"//g')
            created_at=$(echo ${array[$a]} | awk -F ${delimiter} '{print $24}' | sed 's/"//g')
            updated_at=$(echo ${array[$a]} | awk -F ${delimiter} '{print $25}' | sed 's/"//g')
    
	echo $email
done
	

done



