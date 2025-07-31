# Insurance Management System v2.0 - Enhanced Edition

## 🚀 **SYSTEM OVERVIEW**

A comprehensive insurance management system with **500 dummy customers**, **700 policies** across 3 financial years, **agent portal**, and **document management**.

### **Live URLs:**
- **Admin Dashboard:** https://v2.insurance.softpromis.com/dashboard
- **Agent Portal:** https://v2.insurance.softpromis.com/agent-login
- **Setup Page:** https://v2.insurance.softpromis.com/setup.php

---

## 📊 **DUMMY DATA GENERATED**

### **500 Customers**
- Realistic Indian names and addresses
- Distributed across major cities (Mumbai, Delhi, Bangalore, etc.)
- Complete KYC information (Aadhar, PAN)
- Phone numbers, emails, and addresses
- Created across 3 Financial Years (2022-23, 2023-24, 2024-25)

### **700 Policies**
- **Premium Range:** ₹7,000 to ₹30,000 per policy
- **Revenue Range:** ₹500 to ₹4,000 per policy
- **Policy Distribution:**
  - FY 2022-23: 200 policies
  - FY 2023-24: 250 policies
  - FY 2024-25: 250 policies (mix of active, expired, expiring soon)
- **Insurance Types:** Motor, Health, Life
- **Policy Status:** Active, Expired, Expiring Soon

### **3 Agent Accounts Created**
| Name | Phone (Login ID) | Password | Status |
|------|------------------|----------|---------|
| Rajesh Kumar | 9876543210 | Softpro@123 | Active |
| Priya Sharma | 9876543211 | Softpro@123 | Active |
| Amit Singh | 9876543212 | Softpro@123 | Active |

---

## 🏢 **INSURANCE COMPANIES**

**20+ Companies Added:**
- ICICI Lombard General Insurance
- HDFC ERGO General Insurance
- Bajaj Allianz General Insurance
- SBI General Insurance
- Tata AIG General Insurance
- Star Health and Allied Insurance
- LIC of India
- Max Life Insurance
- New India Assurance Company
- Oriental Insurance Company
- Reliance General Insurance
- United India Insurance
- National Insurance Company
- Kotak Mahindra General Insurance
- Future Generali India Insurance
- Cholamandalam MS General Insurance
- Bharti AXA General Insurance
- IFFCO Tokio General Insurance
- Royal Sundaram General Insurance
- Digit General Insurance

---

## 📱 **AGENT PORTAL FEATURES**

### **Dashboard Analytics:**
- Monthly performance tracking
- Commission calculations
- Customer statistics
- Policy expiry alerts
- Performance charts (Chart.js)

### **Agent Login:**
- Phone number as username
- Default password: `Softpro@123`
- Session management
- Role-based access

### **Agent Functions:**
- Add new customers
- Create policies
- View customer list
- Track performance
- Renewal reminders

---

## 📄 **DOCUMENT MANAGEMENT**

### **Customer KYC Documents:**
- **Aadhar Card** (Required)
- **PAN Card** (Required)
- **Passport** (Optional)
- **Driving License** (Optional)
- **Other Documents** (Optional)

### **Policy Documents:**
- **Policy Document** (Required)
- **Proposal Form**

#### **Motor Insurance Specific:**
- Vehicle RC Copy
- Driving License

#### **Health Insurance Specific:**
- Medical Reports
- Previous Health Policy

#### **Life Insurance Specific:**
- Nominee ID Proof
- Income Proof

### **Upload Features:**
- File type validation (PDF, JPG, PNG)
- Size limits (5MB for KYC, 10MB for policies)
- File preview functionality
- Secure storage in organized folders

---

## 🗃️ **DATABASE STRUCTURE**

### **Main Tables:**
- `users` - Admin and agent accounts
- `customers` - Customer information with KYC
- `policies` - Policy details with revenue tracking
- `insurance_companies` - Insurance company master
- `policy_types` - Policy type master
- `customer_documents` - KYC document storage
- `policy_documents` - Policy document storage
- `agent_performance` - Monthly agent performance
- `communication_logs` - Email/WhatsApp automation ready
- `policy_renewals` - Renewal tracking system

---

## 🚀 **SETUP INSTRUCTIONS**

### **1. Database Setup:**
Visit: https://v2.insurance.softpromis.com/setup.php

**Features:**
- One-click database initialization
- Automatic dummy data generation
- Table status verification
- Agent account creation

### **2. Upload Permissions:**
Ensure these directories are writable:
```
uploads/customers/
uploads/policies/
```

### **3. Test Agent Login:**
- URL: https://v2.insurance.softpromis.com/agent-login
- Phone: `9876543210`
- Password: `Softpro@123`

---

## 📧 **FUTURE AUTOMATION READY**

### **Email & WhatsApp Integration:**
- Communication logs table created
- Policy expiry reminders
- Welcome messages
- Payment reminders
- Claim updates

### **Renewal Management:**
- Automatic renewal tracking
- 30-day expiry alerts
- Customer contact information ready
- SMS/WhatsApp notifications ready

---

## 💼 **BUSINESS FEATURES**

### **Financial Tracking:**
- Premium collection tracking
- Revenue per policy
- Agent commission calculation
- Monthly/yearly performance reports
- FY-wise data segregation

### **Customer Management:**
- Complete KYC documentation
- Policy history tracking
- Contact management
- Document verification status

### **Policy Management:**
- Multi-category support (Motor/Health/Life)
- Document attachment
- Status tracking
- Renewal management

---

## 📈 **ANALYTICS DASHBOARD**

### **Admin Dashboard:**
- Revenue trends (12-month rolling)
- Policy distribution charts
- Recent activities
- Expiry notifications
- Financial year summaries

### **Agent Dashboard:**
- Personal performance metrics
- Customer acquisition tracking
- Commission earnings
- Target vs achievement
- Expiring policy alerts

---

## 🔐 **SECURITY FEATURES**

- Session-based authentication
- Role-based access control (Admin/Agent)
- File upload validation
- SQL injection protection
- Secure file storage

---

## 📱 **MOBILE RESPONSIVE**

- Bootstrap 5.3.0 framework
- Mobile-optimized agent portal
- Touch-friendly interface
- Responsive charts and tables

---

## 🛠️ **TECHNICAL SPECIFICATIONS**

- **Backend:** PHP 8.0+
- **Database:** MySQL 8.0+
- **Frontend:** Bootstrap 5.3.0, Chart.js
- **Icons:** Font Awesome 6.4.0
- **File Handling:** Secure upload system
- **Charts:** Chart.js for analytics

---

## 📞 **SUPPORT INFORMATION**

- **System Administrator:** Admin panel access
- **Agent Support:** Contact system administrator
- **Technical Issues:** Check error logs and database status

---

## 🎯 **READY FOR PRODUCTION**

✅ **500 customers** with complete profiles  
✅ **700 policies** across 3 financial years  
✅ **3 agent accounts** with performance data  
✅ **20+ insurance companies** configured  
✅ **Document upload system** implemented  
✅ **Email/WhatsApp automation** framework ready  
✅ **Renewal management** system active  
✅ **Financial year tracking** enabled  
✅ **Mobile responsive** design completed  

**The system is production-ready with comprehensive dummy data for immediate use!**
