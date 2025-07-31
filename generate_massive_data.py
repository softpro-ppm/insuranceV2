#!/usr/bin/env python3
"""
Generate massive seed data for Insurance Management System
Creates 500 customers and 700 policies with realistic Indian data
"""

import random
from datetime import datetime, timedelta
import json

# Indian names database
first_names_male = [
    'Aadhav', 'Aakash', 'Aarush', 'Abhay', 'Abhishek', 'Aditya', 'Ajay', 'Akash', 'Amit', 'Anand',
    'Ankit', 'Anuj', 'Arjun', 'Aryan', 'Ashish', 'Ayush', 'Deepak', 'Dev', 'Dhruv', 'Gaurav',
    'Harsh', 'Ishaan', 'Karan', 'Kartik', 'Krishna', 'Kunal', 'Manish', 'Mohit', 'Nikhil', 'Pranav',
    'Prateek', 'Rahul', 'Raj', 'Rajesh', 'Rakesh', 'Ravi', 'Rohit', 'Sachin', 'Sanjay', 'Shiv',
    'Sunil', 'Suresh', 'Varun', 'Vikash', 'Vikram', 'Vinay', 'Vishal', 'Yash', 'Yogesh', 'Arpit'
]

first_names_female = [
    'Aadhya', 'Ananya', 'Anita', 'Anju', 'Ankita', 'Aparna', 'Asha', 'Deepika', 'Divya', 'Geeta',
    'Kavya', 'Kiran', 'Meera', 'Naina', 'Neha', 'Nikita', 'Pooja', 'Priya', 'Priyanka', 'Radha',
    'Ritu', 'Sangeeta', 'Shreya', 'Sneha', 'Sonia', 'Sunita', 'Swati', 'Tanvi', 'Usha', 'Vidya',
    'Aditi', 'Archana', 'Bharti', 'Chitra', 'Gayatri', 'Isha', 'Jyoti', 'Kajal', 'Lata', 'Madhuri',
    'Mamta', 'Nandini', 'Pallavi', 'Rekha', 'Sapna', 'Seema', 'Shilpa', 'Smita', 'Vandana', 'Veena'
]

last_names = [
    'Agarwal', 'Sharma', 'Gupta', 'Singh', 'Kumar', 'Patel', 'Jain', 'Verma', 'Mishra', 'Yadav',
    'Sinha', 'Reddy', 'Nair', 'Menon', 'Iyer', 'Desai', 'Shah', 'Mehta', 'Kapoor', 'Malhotra',
    'Khanna', 'Chopra', 'Bhatia', 'Sethi', 'Bansal', 'Goel', 'Jindal', 'Aggarwal', 'Mittal', 'Joshi',
    'Pandey', 'Tiwari', 'Dubey', 'Saxena', 'Srivastava', 'Shukla', 'Tripathi', 'Chandra', 'Bhardwaj', 'Arora',
    'Khurana', 'Garg', 'Goyal', 'Bhatt', 'Pathak', 'Kulkarni', 'Deshpande', 'Joshi', 'Patil', 'Jadhav'
]

cities_data = [
    ('Mumbai', 'Maharashtra', '400001'), ('Delhi', 'Delhi', '110001'), ('Bangalore', 'Karnataka', '560001'),
    ('Hyderabad', 'Telangana', '500001'), ('Ahmedabad', 'Gujarat', '380001'), ('Chennai', 'Tamil Nadu', '600001'),
    ('Kolkata', 'West Bengal', '700001'), ('Surat', 'Gujarat', '395001'), ('Pune', 'Maharashtra', '411001'),
    ('Jaipur', 'Rajasthan', '302001'), ('Lucknow', 'Uttar Pradesh', '226001'), ('Kanpur', 'Uttar Pradesh', '208001'),
    ('Nagpur', 'Maharashtra', '440001'), ('Indore', 'Madhya Pradesh', '452001'), ('Thane', 'Maharashtra', '400601'),
    ('Bhopal', 'Madhya Pradesh', '462001'), ('Visakhapatnam', 'Andhra Pradesh', '530001'), ('Pimpri', 'Maharashtra', '411018'),
    ('Patna', 'Bihar', '800001'), ('Vadodara', 'Gujarat', '390001'), ('Ghaziabad', 'Uttar Pradesh', '201001'),
    ('Ludhiana', 'Punjab', '141001'), ('Agra', 'Uttar Pradesh', '282001'), ('Nashik', 'Maharashtra', '422001'),
    ('Faridabad', 'Haryana', '121001'), ('Meerut', 'Uttar Pradesh', '250001'), ('Rajkot', 'Gujarat', '360001'),
    ('Kalyan', 'Maharashtra', '421301'), ('Vasai', 'Maharashtra', '401202'), ('Varanasi', 'Uttar Pradesh', '221001'),
    ('Srinagar', 'Jammu and Kashmir', '190001'), ('Aurangabad', 'Maharashtra', '431001'), ('Dhanbad', 'Jharkhand', '826001'),
    ('Amritsar', 'Punjab', '143001'), ('Navi Mumbai', 'Maharashtra', '400614'), ('Allahabad', 'Uttar Pradesh', '211001'),
    ('Ranchi', 'Jharkhand', '834001'), ('Howrah', 'West Bengal', '711101'), ('Coimbatore', 'Tamil Nadu', '641001'),
    ('Jabalpur', 'Madhya Pradesh', '482001'), ('Gwalior', 'Madhya Pradesh', '474001'), ('Vijayawada', 'Andhra Pradesh', '520001'),
    ('Jodhpur', 'Rajasthan', '342001'), ('Madurai', 'Tamil Nadu', '625001'), ('Raipur', 'Chhattisgarh', '492001'),
    ('Kota', 'Rajasthan', '324001'), ('Guwahati', 'Assam', '781001'), ('Chandigarh', 'Chandigarh', '160001'),
    ('Solapur', 'Maharashtra', '413001'), ('Hubli', 'Karnataka', '580001'), ('Bareilly', 'Uttar Pradesh', '243001')
]

streets = [
    'MG Road', 'Station Road', 'Main Road', 'Park Street', 'Gandhi Road', 'Nehru Road', 'Mall Road',
    'Civil Lines', 'Model Town', 'Sector', 'Block', 'Colony', 'Layout', 'Nagar', 'Puram', 'Vihar',
    'Extension', 'Cross', 'Circle', 'Square', 'Market', 'Bazaar', 'Marg', 'Path', 'Lane', 'Avenue'
]

# Policy categories and their typical premium ranges
policy_types = [
    ('Motor Insurance', 'motor', 8000, 25000),
    ('Health Insurance', 'health', 12000, 50000),
    ('Life Insurance', 'life', 15000, 75000),
    ('Travel Insurance', 'travel', 2000, 8000),
    ('Home Insurance', 'property', 5000, 20000),
    ('Personal Accident', 'health', 3000, 12000),
    ('Term Life Insurance', 'life', 8000, 30000),
    ('Critical Illness', 'health', 15000, 40000),
    ('Two Wheeler Insurance', 'motor', 2500, 8000),
    ('Commercial Vehicle Insurance', 'motor', 15000, 60000)
]

def generate_customer_sql(start_id, count):
    sql_lines = []
    
    for i in range(count):
        customer_id = start_id + i
        
        # Random gender and name
        gender = random.choice(['male', 'female'])
        if gender == 'male':
            first_name = random.choice(first_names_male)
        else:
            first_name = random.choice(first_names_female)
        
        last_name = random.choice(last_names)
        name = f"{first_name} {last_name}"
        
        # Email and phone
        email = f"{first_name.lower()}.{last_name.lower()}{customer_id}@email.com"
        phone = f"98765{str(customer_id).zfill(5)}"
        alt_phone = f"98766{str(customer_id).zfill(5)}"
        
        # Random birth date (25-60 years old)
        age = random.randint(25, 60)
        birth_year = 2024 - age
        birth_month = random.randint(1, 12)
        birth_day = random.randint(1, 28)
        birth_date = f"{birth_year}-{birth_month:02d}-{birth_day:02d}"
        
        # Random address
        city, state, base_pincode = random.choice(cities_data)
        street = random.choice(streets)
        house_no = random.randint(1, 999)
        area = random.choice(['Sector', 'Block', 'Layout', 'Colony'])
        area_no = random.randint(1, 50)
        address = f"{house_no} {street}, {area} {area_no}"
        
        # Generate unique IDs
        aadhar = f"123456{str(customer_id).zfill(6)}"
        pan = f"ABCDE{str(customer_id).zfill(4)}{chr(65 + (customer_id % 26))}"
        
        # Random creation details
        created_by = random.randint(1, 5)  # Agent IDs 1-5
        created_date = datetime(2022, 1, 1) + timedelta(days=random.randint(0, 730))
        created_at = created_date.strftime('%Y-%m-%d %H:%M:%S')
        
        customer_code = f"CUST{str(customer_id).zfill(6)}"
        
        sql_line = f"('{customer_code}', '{name}', '{email}', '{phone}', '{alt_phone}', '{birth_date}', '{gender}', '{address}', '{city}', '{state}', '{base_pincode}', '{aadhar}', '{pan}', {created_by}, '{created_at}')"
        
        sql_lines.append(sql_line)
    
    return sql_lines

def generate_policy_sql(customer_count, policy_count):
    sql_lines = []
    
    for i in range(policy_count):
        policy_id = i + 1
        
        # Random customer (1 to customer_count)
        customer_id = random.randint(1, customer_count)
        
        # Random insurance company (1-23)
        company_id = random.randint(1, 23)
        
        # Random policy type
        policy_name, category, min_premium, max_premium = random.choice(policy_types)
        
        # Policy details
        policy_number = f"POL{datetime.now().year}{str(policy_id).zfill(6)}"
        premium = random.randint(min_premium, max_premium)
        sum_insured = premium * random.randint(20, 100)  # 20x to 100x of premium
        revenue = int(premium * random.uniform(0.15, 0.25))  # 15-25% commission
        
        # Random policy dates (last 2 years)
        start_date = datetime(2022, 1, 1) + timedelta(days=random.randint(0, 730))
        end_date = start_date + timedelta(days=365)  # 1 year policy
        
        policy_type_id = (i % len(policy_types)) + 1  # Cycle through policy types
        
        status = random.choice(['active', 'active', 'active', 'expired', 'cancelled'])  # Most are active
        
        sql_line = f"('{policy_number}', {customer_id}, {company_id}, {policy_type_id}, '{category}', '{start_date.strftime('%Y-%m-%d')}', '{end_date.strftime('%Y-%m-%d')}', {premium}, {sum_insured}, {revenue}, '{status}', '{start_date.strftime('%Y-%m-%d %H:%M:%S')}')"
        
        sql_lines.append(sql_line)
    
    return sql_lines

def main():
    print("Generating massive seed data...")
    
    # Generate customers (starting from 21 since we already have 20)
    customers = generate_customer_sql(21, 480)  # Generate 480 more customers
    
    # Generate 700 policies
    policies = generate_policy_sql(500, 700)
    
    # Write to SQL file
    with open('/Users/rajesh/Documents/GitHub/insuranceV2/database/massive_seed_data_part2.sql', 'w') as f:
        f.write("-- Additional 480 customers (21-500)\n")
        f.write("INSERT IGNORE INTO customers (customer_code, name, email, phone, alternate_phone, date_of_birth, gender, address, city, state, pincode, aadhar_number, pan_number, created_by, created_at) VALUES\n")
        
        # Write customers in chunks of 50
        for i in range(0, len(customers), 50):
            chunk = customers[i:i+50]
            f.write(",\n".join(chunk))
            if i + 50 < len(customers):
                f.write(",\n")
            else:
                f.write(";\n\n")
        
        f.write("-- 700 Policies\n")
        f.write("INSERT IGNORE INTO policies (policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, revenue, status, created_at) VALUES\n")
        
        # Write policies in chunks of 50
        for i in range(0, len(policies), 50):
            chunk = policies[i:i+50]
            f.write(",\n".join(chunk))
            if i + 50 < len(policies):
                f.write(",\n")
            else:
                f.write(";\n\n")
    
    print("✅ Generated massive_seed_data_part2.sql")
    print(f"✅ Created {len(customers)} additional customers (total will be 500)")
    print(f"✅ Created {len(policies)} policies")
    print("\nSample generated data:")
    print("Customer:", customers[0] if customers else "None")
    print("Policy:", policies[0] if policies else "None")

if __name__ == "__main__":
    main()
