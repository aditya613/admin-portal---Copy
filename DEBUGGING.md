## 🔍 Debugging Guide - No Data Showing

Based on the checks, here are the most likely issues and solutions:

### Issue 1: MongoDB Not Installed or Running ❌

**Symptoms:**
- Can't connect to MongoDB
- "Connection refused" errors
- No data showing

**Solutions:**

#### Option A: Install MongoDB Locally
1. **Download MongoDB Community Server:**
   ```
   https://www.mongodb.com/try/download/community
   ```

2. **Install and start MongoDB:**
   - Run the installer
   - Start MongoDB service from Services (Windows) or:
   ```powershell
   net start MongoDB
   ```

3. **Verify it's running:**
   ```powershell
   # Check if port 27017 is listening
   netstat -an | findstr "27017"
   ```

#### Option B: Use MongoDB Atlas (Cloud)
1. **Create free account:** https://www.mongodb.com/cloud/atlas/register
2. **Create cluster and get connection string**
3. **Update `.env`:**
   ```env
   MONGODB_DSN=mongodb+srv://username:password@cluster.mongodb.net
   MONGODB_DATABASE=job_scraper
   ```

#### Option C: Use Docker
```powershell
docker run -d -p 27017:27017 --name mongodb mongo:latest
```

---

### Issue 2: No Data in MongoDB ❌

**Symptoms:**
- MongoDB is running but no jobs show
- Empty collection

**Solutions:**

1. **Check if you have a JSON file with job data**
   - Your sample document structure is ready
   - Need actual job data file

2. **Create sample data for testing:**

Save this as `sample-jobs.json`:
```json
[
  {
    "id": "test-job-1",
    "site": "indeed",
    "job_url": "https://indeed.com/job/1",
    "title": "Senior Software Engineer",
    "company": "TechCorp India",
    "location": "Bangalore, Karnataka, India",
    "date_posted": {"$date": "2026-01-05T00:00:00.000Z"},
    "job_type": "Full-time",
    "is_remote": false,
    "description": "We are seeking an experienced Senior Software Engineer...",
    "company_logo": "https://via.placeholder.com/150",
    "company_url": "https://techcorp.com",
    "company_num_employees": "1000-5000",
    "company_description": "Leading technology company"
  },
  {
    "id": "test-job-2",
    "site": "linkedin",
    "job_url": "https://linkedin.com/job/2",
    "title": "Full Stack Developer",
    "company": "StartupXYZ",
    "location": "Mumbai, Maharashtra, India",
    "date_posted": {"$date": "2026-01-06T00:00:00.000Z"},
    "job_type": "Full-time",
    "is_remote": true,
    "description": "Join our team as a Full Stack Developer...",
    "company_logo": "https://via.placeholder.com/150",
    "company_url": "https://startupxyz.com",
    "company_num_employees": "50-200",
    "company_description": "Innovative startup"
  }
]
```

3. **Import the data:**

**If you have MongoDB CLI tools:**
```powershell
mongoimport --db job_scraper --collection job_listings --file sample-jobs.json --jsonArray
```

**If you don't have mongoimport:**
- Use **MongoDB Compass** (GUI tool)
- Connect to localhost:27017
- Create database: `job_scraper`
- Create collection: `job_listings`
- Import JSON file

---

### Issue 3: Wrong Database/Collection Name ❌

**Check your configuration:**

1. **Open `.env` and verify:**
   ```env
   MONGODB_DSN=mongodb://localhost:27017
   MONGODB_DATABASE=job_scraper
   ```

2. **Clear cache:**
   ```powershell
   php artisan config:clear
   php artisan cache:clear
   ```

---

### Issue 4: Model/Controller Issues ❌

**Check Laravel logs:**
```powershell
Get-Content storage/logs/laravel.log -Tail 50
```

**Test the model directly:**
```powershell
php artisan tinker
```

Then in tinker:
```php
// Test connection
DB::connection('mongodb')->collection('job_listings')->count()

// Test model
App\Models\JobListing::count()

// Get first job
App\Models\JobListing::first()

// Exit tinker
exit
```

---

## 🚀 Quick Start (Complete Setup)

### Step 1: Access Debug Page
Visit: **http://localhost:8000/debug-mongodb.php**

This will show you exactly what's wrong!

### Step 2: Install MongoDB (if needed)
Choose one method above (Local, Atlas, or Docker)

### Step 3: Import Sample Data
Use the sample-jobs.json above or your actual job data

### Step 4: Test the Portal
Visit: **http://localhost:8000/admin/jobs**

---

## 📋 Checklist

- [ ] MongoDB is installed and running
- [ ] Port 27017 is accessible
- [ ] Database "job_scraper" exists
- [ ] Collection "job_listings" exists
- [ ] Collection has documents
- [ ] .env has correct MONGODB_DSN
- [ ] Config cache is cleared
- [ ] Laravel can connect (test in tinker)

---

## 🆘 Still Not Working?

Run these commands and share the output:

```powershell
# 1. Check PHP MongoDB extension
php -m | Select-String "mongodb"

# 2. Check MongoDB connection
php artisan tinker
# Then type: DB::connection('mongodb')->collection('job_listings')->count()

# 3. Check logs
Get-Content storage/logs/laravel.log -Tail 20

# 4. Test controller
php artisan route:list | Select-String "jobs"
```

**Access the debug page for detailed diagnostics:**
http://localhost:8000/debug-mongodb.php
