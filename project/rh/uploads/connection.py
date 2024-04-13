import mysql.connector
import datetime
import sys

# Specify the file path
if len(sys.argv) > 1:
    # Store the arguments
    arguments = sys.argv[1:]
file_path = arguments[0]

try:
    # Open the file in read mode ('r' mode)
    with open(file_path, "r") as file:
        # Read all the text from the file
        file_content = file.read()
        date = file_content[0 : file_content.index("\n")]
        date = datetime.datetime.strptime(date, '%d/%m/%Y')
        date = date.strftime('%Y-%m-%d')
        file_content = file_content[file_content.index("\n")+1 : len(file_content)]
        matricule = file_content[0 : file_content.index("\n")]
        file_content = file_content[file_content.index("\n")+1 : len(file_content)]
except FileNotFoundError:
    print("File not found.")
except IOError:
    print("Error reading file.")

# MySQL database configuration
db_config = {
    'user': 'mahdi',
    'password': '000',
    'host': '127.0.0.1',
    'database': 'userdb',
    'port': '3306'  # Default MySQL port
}

try:
    # Establishing a connection to the MySQL database
    connection = mysql.connector.connect(**db_config)

    if connection.is_connected():
        print('Connected to MySQL database')
                # Creating a cursor object
        cursor = connection.cursor()

        # Sample insert query
        insert_query = "INSERT INTO assurance (text, matricule, date) VALUES (%s, %s, %s)"
        # Sample data to be inserted
        data_to_insert = (file_content, matricule, date)

        # Executing the insert query
        cursor.execute(insert_query, data_to_insert)

        # Committing the transaction
        connection.commit()

        # Closing the cursor
        cursor.close()

        # Perform database operations here...

except mysql.connector.Error as e:
    print(f"Error connecting to MySQL database: {e}")

finally:
    # Closing database connection
    if 'connection' in locals() and connection.is_connected():
        connection.close()
        print('Database connection closed.')
