import sys
import pdfplumber
import mysql.connector
import datetime

if len(sys.argv) > 1:
    # Store the arguments
    arguments = sys.argv[1:]
pdf_path = arguments[0]

def extract_text_from_pdf(pdf_path):
    with pdfplumber.open(pdf_path) as pdf:
        text = ''
        for page in pdf.pages:
            text += page.extract_text()
    return text

pdf_text = extract_text_from_pdf(pdf_path)
ch = pdf_text.upper()
mat=[]

#get the date
mat.append(ch[ch.index("LE :")+5:ch.index("LE :")+15])
#matricule
mat.append(ch[ch.index("MATRICULE :")+12:ch.index("MATRICULE :")+16])
ch2 = ch[ch.index("TYPE :")+7:len(ch)]
ch2 = ch2[ch2.index("\n")+1:len(ch2)]
ch2= ch2[0 : ch2.index("PAGE : 1")-1]
l= list(ch2.split("\n"))
i=-1
for ch in l :
    i+=1
    
    m=[]
    if(ch[0] != "A" and ch[0] !="D" and ch[0] !="T" and ch[0] !="P"):
        m.append("X")
        #date
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #nom
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #prenom
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #executant
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #acte
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #qte
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #frais_reel
        m.append(ch[0 : ch.index(" ")+4])
        ch=ch[ch.index(" ")+5 : len(ch)]
        #mutuel
        m.append(ch[0 : ch.index(" ")])
        ch=ch[ch.index(" ")+1 : len(ch)]
        #remb
        if(m[-1] != 0):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
        else : 
            ch=ch[ch.index(" ")+1 : len(ch)]
            m.append(ch[0 : ch.index(" ")])

        #non_remb

        if(m[-1] != 0):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
        else : 
            ch=ch[ch.index(" ")+1 : len(ch)]
            m.append(ch[0 : ch.index(" ")])

        #tpg
        m.append(ch[0 : len(ch)])
        mat.append(m)
    elif(ch[0] == "A"):
        m.append("A")
        m.append(ch[ch.index(" A ")+3 : len(ch)])
        line = l[i+1]
        mat.append(m)
    elif(ch[0] == "D"):
        m.append("D")
        ch = ch[ch.index(": ")+2 : len(ch)]
        #decompte
        m.append(ch[0 : ch.index(" ")])

        ch=ch[ch.index(" ")+1 : len(ch)]
        
        ch = ch[ch.index(": ")+2 : len(ch)]
        #date
        m.append(ch[0 : ch.index(" ")])

        ch=ch[ch.index(" ")+1 : len(ch)]
        ch = ch[ch.index(": ")+2 : len(ch)]
        #total decompte
        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]
        
        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]

        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]

        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]            
        
        m.append(ch[0 : len(ch)])
        mat.append(m)
        
    elif(ch[0] == "T"):
        m.append("T")
        ch = ch[ch.index(": ")+2 : len(ch)]
        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]  

        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]

        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]

        if(ch[0] != "0"):
            m.append(ch[0 : ch.index(" ")+4])
            ch=ch[ch.index(" ")+5 : len(ch)]
            
        else : 
            m.append(ch[0 : ch.index(" ")])
            ch=ch[ch.index(" ")+1 : len(ch)]            
        m.append(ch[0 : len(ch)])
        mat.append(m)
text=""
i=0
for line in mat :
    if(i<2):
        text = text + line + "\n"
        i+=1
    else:
        for j in line:
            text = text + j + ";"
        text = text + "\n"
text = text[0 : len(text)-1]

#connection 

try:
    file_content = text
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


