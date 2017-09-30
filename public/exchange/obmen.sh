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

export_user='/var/www/sint.odessa/public/exchange/files/1c_user.csv'
export_order='/var/www/sint.odessa/public/exchange/files/1c_order.csv'
import_user='/var/www/sint.odessa/public/exchange/files/site_user.csv'
import_order='/var/www/sint.odessa/public/exchange/files/site_order.csv'

# Export to 1C
mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user}.updated_at > '$date_old' OR ${table_user_profile}.updated_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_user}
#mysql -u$USER -p$PASSWD -D$BASE -e "SELECT id,user_id,1c_id,1cuser_id,type_order_id,type_client_id,client_name,user_company,phone,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,type_payment_id,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,comment,status_id,created_at,updated_at FROM ${table_order} WHERE created_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_order}

# Import from 1C
readarray array < ${import_user}
for ((a=1; a < ${#array[*]}; a++))
do
	id_str=$(echo ${array[$a]} | awk -F ${delimiter} '{print $1}' | sed 's/"//g') # ID
			name=$(echo ${array[$a]} | awk -F ${delimiter} '{print $26}')
			email=$(echo ${array[$a]} | awk -F ${delimiter} '{print $27}')
			c_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $2}')
            type_client_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $3}')
            type_payment_id=$(echo ${array[$a]} | awk -F ${delimiter} '{print $4}')
            client_name=$(echo ${array[$a]} | awk -F ${delimiter} '{print $5}')
            delivery_town=$(echo ${array[$a]} | awk -F ${delimiter} '{print $6}')
            delivery_street=$(echo ${array[$a]} | awk -F ${delimiter} '{print $7}')
            delivery_house=$(echo ${array[$a]} | awk -F ${delimiter} '{print $8}')
            delivery_house_block=$(echo ${array[$a]} | awk -F ${delimiter} '{print $9}')
            delivery_office=$(echo ${array[$a]} | awk -F ${delimiter} '{print $10}')
            phone=$(echo ${array[$a]} | awk -F ${delimiter} '{print $11}')
            user_company=$(echo ${array[$a]} | awk -F ${delimiter} '{print $12}')
            company_full=$(echo ${array[$a]} | awk -F ${delimiter} '{print $13}')
            edrpou=$(echo ${array[$a]} | awk -F ${delimiter} '{print $14}')
            inn=$(echo ${array[$a]} | awk -F ${delimiter} '{print $15}')
            code_index=$(echo ${array[$a]} | awk -F ${delimiter} '{print $16}')
            region=$(echo ${array[$a]} | awk -F ${delimiter} '{print $17}')
            area=$(echo ${array[$a]} | awk -F ${delimiter} '{print $18}')
            city=$(echo ${array[$a]} | awk -F ${delimiter} '{print $19}')
            street=$(echo ${array[$a]} | awk -F ${delimiter} '{print $20}')
            house=$(echo ${array[$a]} | awk -F ${delimiter} '{print $21}')
            house_block=$(echo ${array[$a]} | awk -F ${delimiter} '{print $22}')
            office=$(echo ${array[$a]} | awk -F ${delimiter} '{print $23}')
            created_at=$(echo ${array[$a]} | awk -F ${delimiter} '{print $24}')
            updated_at=$(echo ${array[$a]} | awk -F ${delimiter} '{print $25}')
    
		if [ "${id_str}" ]
        then
		mysql -u$USER -p$PASSWD -D$BASE -e "UPDATE ${table_user} SET
		    name = '${name}',
		    email = '${email}'
		WHERE id = ${id_str}; 
		UPDATE ${table_user_profile} SET 
		 	1c_id = '${c_id}',
            type_client_id = '${type_client_id}',
            type_payment_id = '${type_payment_id}',
            client_name = '${client_name}',
            delivery_town = '${delivery_town}',
            delivery_street = '${delivery_street}',
            delivery_house = '${delivery_house}',
            delivery_house_block = '${delivery_house_block}',
            delivery_office = '${delivery_office}',
            phone = '${phone}',
            user_company = '${user_company}',
            company_full = '${company_full}',
            edrpou = '${edrpou}',
            inn = '${inn}',
            code_index = '${code_index}',
            region = '${region}',
            area = '${area}',
            city = '${city}',
            street = '${street}',
            house = '${house}',
            house_block = '${house_block}',
            office = '${office}',
            created_at = '${created_at}',
            updated_at = '${updated_at}'
        WHERE user_id = ${id_str}"        
	else
	    # Insert data
		data_sql=$(echo ${array[$a]} | awk -F ${delimiter} '{ for(i = 2; i <= NF-2; i++) { printf("\"%s\", ", $i); } }' | sed 's/^\(.*\),/\1/')
		user_id=$(mysql -u$USER -p$PASSWD -D$BASE -e "INSERT INTO ${table_user} (name,email,created_at) VALUES('${name}', '${email}', '${created_at}'); SELECT LAST_INSERT_ID() as '';")
		# id user belong to
		mysql -u$USER -p$PASSWD -D$BASE -e "INSERT INTO ${table_user_profile} (user_id,1c_id,type_client_id,type_payment_id,client_name,delivery_town,delivery_street,delivery_house,delivery_house_block,delivery_office,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,created_at,updated_at) VALUES(${user_id},${data_sql})"
	fi
done

