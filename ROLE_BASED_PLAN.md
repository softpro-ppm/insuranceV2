# Insurance Management System - Role-Based Access Control Plan

## 📋 USER ROLES & PERMISSIONS

### 🎭 1. ADMIN (Super User)
**Login:** admin / admin123
**Full System Access:**
- ✅ View/Add/Edit/Delete ALL policies under ANY agent
- ✅ View/Add/Edit/Delete ALL customers  
- ✅ Agent Management (Create/Edit/Delete agents)
- ✅ Receptionist Management
- ✅ Complete Revenue/Income Analytics (All agents combined)
- ✅ Business Trends (All business)
- ✅ Download ANY policy documents
- ✅ Commission Management
- ✅ System Settings & Configuration
- ✅ Database Management
- ✅ Reports & Analytics Dashboard

**Dashboard Features:**
- Total business overview
- All agents performance
- Revenue trends (all agents)
- Commission tracking
- Policy distribution
- Customer analytics

---

### 👨‍💼 2. AGENT 
**Login:** Phone number / Softpro@123
**Limited Access:**
- ✅ View ONLY their own policies  
- ✅ View ONLY their own customers
- ✅ View ONLY their business trends
- ✅ View ONLY their income/commission trends
- ❌ Cannot download customer policies (Error: "Contact admin for download")
- ❌ Cannot see other agents' data
- ❌ Cannot access admin functions
- ❌ Cannot see total system revenue

**Dashboard Features:**
- Personal performance metrics
- Own policy count & status
- Personal commission earnings
- Own customer base
- Personal business trends
- Renewal reminders (own policies)

---

### 🏢 3. RECEPTIONIST
**Login:** receptionist / admin123
**Operational Access:**
- ✅ Add policies on behalf of ANY agent
- ✅ Add policies for direct walk-in business (assign to admin)
- ✅ View/Add/Edit/Delete ANY customer
- ✅ View/Add/Edit/Delete ANY policy
- ✅ View business trends (policy counts, types)
- ❌ Cannot see income/revenue trends
- ❌ Cannot see commission data
- ❌ Cannot manage agents
- ❌ Cannot access financial reports

**Dashboard Features:**
- Policy creation interface
- Customer management
- Business activity trends
- Policy status overview
- Quick actions panel

---

## 🔄 WORKFLOW PROCESS

### 📝 Policy Creation Workflow:

1. **Receptionist creates policy:**
   - Selects target agent from dropdown
   - OR assigns to admin for direct business
   - Policy appears in selected agent's dashboard

2. **Agent login:**
   - Sees only policies assigned to them
   - Can view customer details
   - Cannot download policy documents

3. **Admin oversight:**
   - Can reassign policies between agents
   - Can view all business data
   - Can download any documents
   - Can generate comprehensive reports

---

## 🛡️ SECURITY FEATURES

### Access Control:
- Role-based route protection
- Session-based authentication
- Permission checks on every action
- Data isolation between agents

### Business Logic:
- Commission auto-calculation per agent
- Revenue tracking per agent
- Performance metrics per agent
- Business trend analysis

---

## 📊 DASHBOARD CUSTOMIZATION

### Admin Dashboard:
- Multi-agent performance comparison
- Total system revenue charts
- Policy distribution analytics
- Agent ranking system

### Agent Dashboard:
- Personal KPI widgets
- Own customer list
- Commission tracker
- Renewal alerts

### Receptionist Dashboard:
- Quick policy creation
- Customer search & management
- Business activity log
- Policy status overview

---

## 🚀 IMPLEMENTATION PHASES

### Phase 1: Database Updates
- Update user roles (add 'receptionist')
- Add agent_id selection in policy forms
- Create role-based permission tables

### Phase 2: Authentication & Authorization
- Implement role-based route protection
- Create permission middleware
- Update login systems

### Phase 3: Dashboard Customization
- Role-specific dashboard views
- Data filtering by user role
- Revenue/income restrictions

### Phase 4: Business Logic
- Policy assignment workflow
- Commission calculation per agent
- Document download restrictions

### Phase 5: Testing & Deployment
- Role-based testing
- Permission verification
- Performance optimization

---

## 📋 NEXT STEPS

1. ✅ Backup completed
2. 🔄 Update database schema
3. 🔄 Implement role-based authentication
4. 🔄 Create receptionist user
5. 🔄 Update policy creation forms
6. 🔄 Implement dashboard restrictions
7. 🔄 Add document download controls
8. 🔄 Test all role permissions

---

**Status:** Planning Complete ✅
**Ready for Implementation:** ✅
