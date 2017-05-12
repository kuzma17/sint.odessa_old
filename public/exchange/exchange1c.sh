#!/bin/bash

START=$(date +%s)

USER="root" # MySQL User
PASSWD="170270" # MySQL password
BASE="sint_odessa"

date_old=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT exchange as '' FROM exchanges WHERE id = 1") # Date old exchange

delimiter=';'
quotes='"'

table_user='test_users'
table_user_profile='test_user_profiles'
table_order='test_orders'

export_user='/home/kuzma/Worck/exchange1c/files/1c_user.csv'
export_order='/home/kuzma/Worck/exchange1c/files/1c_order.csv'
import_user='/home/kuzma/Worck/exchange1c/files/site_user.csv'
import_order='/home/kuzma/Worck/exchange1c/files/site_order.csv'

# Export to 1C
mysql -u$USER -p$PASSWD -D$BASE -e "SELECT ${table_user}.id,1c_id,type_client_id,type_payment_id,client_name,address,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,${table_user_profile}.created_at,${table_user_profile}.updated_at,name,email FROM ${table_user_profile} LEFT JOIN ${table_user} ON ${table_user_profile}.user_id = ${table_user}.id WHERE ${table_user_profile}.updated_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_user}
mysql -u$USER -p$PASSWD -D$BASE -e "SELECT id,user_id,1c_id,1cuser_id,type_order_id,type_client_id,client_name,user_company,phone,address,type_payment_id,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,comment,status_id,created_at,updated_at FROM ${table_order} WHERE created_at > '$date_old'" | sed "s/'/\'/;s/\t/$quotes$delimiter$quotes/g;s/^/$quotes/;s/$/$quotes/;s/\n//g" > ${export_order}

# Import from 1C
readarray array < ${import_user}
for ((a=1; a < ${#array[*]}; a++))
do
	id_str=$(echo ${array[$a]} | awk -F ";" '{print $1}' | sed 's/"//g') # ID
    if [ "${id_str}" ]
        then
		mysql -u$USER -p$PASSWD -D$BASE -e "UPDATE ${table_user} SET
		    name = $(echo ${array[$a]} | awk -F ';' '{print $22}'),
		    email = $(echo ${array[$a]} | awk -F ';' '{print $23}')
		WHERE id = ${id_str};
        UPDATE ${table_user_profile} SET
            1c_id = $(echo ${array[$a]} | awk -F ';' '{print $2}'),
            type_client_id = $(echo ${array[$a]} | awk -F ';' '{print $3}'),
            type_payment_id = $(echo ${array[$a]} | awk -F ';' '{print $4}'),
            client_name = $(echo ${array[$a]} | awk -F ';' '{print $5}'),
            address = $(echo ${array[$a]} | awk -F ';' '{print $6}'),
            phone = $(echo ${array[$a]} | awk -F ';' '{print $7}'),
            user_company = $(echo ${array[$a]} | awk -F ';' '{print $8}'),
            company_full = $(echo ${array[$a]} | awk -F ';' '{print $9}'),
            edrpou = $(echo ${array[$a]} | awk -F ';' '{print $10}'),
            inn = $(echo ${array[$a]} | awk -F ';' '{print $11}'),
            code_index = $(echo ${array[$a]} | awk -F ';' '{print $12}'),
            region = $(echo ${array[$a]} | awk -F ';' '{print $13}'),
            area = $(echo ${array[$a]} | awk -F ';' '{print $14}'),
            city = $(echo ${array[$a]} | awk -F ';' '{print $15}'),
            street = $(echo ${array[$a]} | awk -F ';' '{print $16}'),
            house = $(echo ${array[$a]} | awk -F ';' '{print $17}'),
            house_block = $(echo ${array[$a]} | awk -F ';' '{print $18}'),
            office = $(echo ${array[$a]} | awk -F ';' '{print $19}'),
            created_at = $(echo ${array[$a]} | awk -F ';' '{print $20}'),
            updated_at = $(echo ${array[$a]} | awk -F ';' '{print $21}')
        WHERE user_id = ${id_str}"
	else
	    # Insert data
		data_sql=$(echo ${array[$a]} | awk -F ";" '{ for(i = 2; i <= NF-2; i++) { printf("%s, ", $i); } }' | sed 's/^\(.*\),/\1/')
		user_id=$(mysql -u$USER -p$PASSWD -D$BASE -e "INSERT INTO ${table_user} (name,email)  VALUES($(echo ${array[$a]} | awk -F ';' '{print $22}'), $(echo ${array[$a]} | awk -F ';' '{print $23}')); SELECT LAST_INSERT_ID() as '';")
		#echo $user_id # id user belong to
		mysql -u$USER -p$PASSWD -D$BASE -e "INSERT INTO ${table_user_profile} (user_id,1c_id,type_client_id,type_payment_id,client_name,address,phone,user_company,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,created_at,updated_at) VALUES(${user_id},${data_sql})"
	fi
done

readarray array < ${import_order}
for ((a=1; a < ${#array[*]}; a++))
do
	id_str=$(echo ${array[$a]} | awk -F ";" '{print $1}' | sed 's/"//g') # ID

	if [ "${id_str}" ]
        then
		mysql -u$USER -p$PASSWD -D$BASE -e "UPDATE ${table_order} SET
		            user_id = $(echo ${array[$a]} | awk -F ';' '{print $2}'),
		            1c_id = $(echo ${array[$a]} | awk -F ';' '{print $3}'),
                    1cuser_id = $(echo ${array[$a]} | awk -F ';' '{print $4}'),
                    type_order_id = $(echo ${array[$a]} | awk -F ';' '{print $5}'),
                    type_client_id = $(echo ${array[$a]} | awk -F ';' '{print $6}'),
                    client_name = $(echo ${array[$a]} | awk -F ';' '{print $7}'),
                    user_company = $(echo ${array[$a]} | awk -F ';' '{print $8}'),
                    phone = $(echo ${array[$a]} | awk -F ';' '{print $9}'),
                    address = $(echo ${array[$a]} | awk -F ';' '{print $10}'),
                    type_payment_id = $(echo ${array[$a]} | awk -F ';' '{print $11}'),
                    company_full = $(echo ${array[$a]} | awk -F ';' '{print $12}'),
                    edrpou = $(echo ${array[$a]} | awk -F ';' '{print $13}'),
                    inn = $(echo ${array[$a]} | awk -F ';' '{print $14}'),
                    code_index = $(echo ${array[$a]} | awk -F ';' '{print $15}'),
                    region = $(echo ${array[$a]} | awk -F ';' '{print $16}'),
                    area = $(echo ${array[$a]} | awk -F ';' '{print $17}'),
                    city = $(echo ${array[$a]} | awk -F ';' '{print $18}'),
                    street = $(echo ${array[$a]} | awk -F ';' '{print $19}'),
                    house = $(echo ${array[$a]} | awk -F ';' '{print $20}'),
                    house_block = $(echo ${array[$a]} | awk -F ';' '{print $21}'),
                    office = $(echo ${array[$a]} | awk -F ';' '{print $22}'),
                    comment = $(echo ${array[$a]} | awk -F ';' '{print $23}'),
                    status_id = $(echo ${array[$a]} | awk -F ';' '{print $24}'),
                    created_at = $(echo ${array[$a]} | awk -F ';' '{print $25}'),
                    updated_at = $(echo ${array[$a]} | awk -F ';' '{print $26}')
		        WHERE id = ${id_str}"

	else
	    # Insert data
		if [ $(echo ${array[$a]} | awk -F ';' '{print $2}' | sed 's/"//g') ]
		    then
            # if there is field user_id
		     values=$(echo ${array[$a]} | awk -F ";" '{ for(i = 2; i <= NF; i++) { printf("%s, ", $i); } }' | sed 's/^\(.*\),/\1/')
		    else
		    user_id=$(mysql -u$USER -p$PASSWD -D$BASE -e "SELECT user_id as '' FROM ${table_user_profile} WHERE 1c_id = $(echo ${array[$a]} | awk -F ';' '{print $4}')")
		    values=${user_id},$(echo ${array[$a]} | awk -F ";" '{ for(i = 3; i <= NF; i++) { printf("%s, ", $i); } }' | sed 's/^\(.*\),/\1/')
		fi
		mysql -u$USER -p$PASSWD -D$BASE -e "INSERT INTO ${table_order} (user_id,1c_id,1cuser_id,type_order_id,type_client_id,client_name,user_company,phone,address,type_payment_id,company_full,edrpou,inn,code_index,region,area,city,street,house,house_block,office,comment,status_id,created_at,updated_at) VALUES(${values})"
	fi
done

$(mysql -u$USER -p$PASSWD -D$BASE -e "UPDATE exchanges SET exchange = CURRENT_TIMESTAMP WHERE id = 1") # Update date exchange

END=$(date +%s)
DIFF=$(( $END - $START ))

echo 'Time:' $( echo $DIFF)

