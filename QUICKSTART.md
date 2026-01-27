# 🚀 Quick Start Guide - Job Portal with MongoDB

## What's Been Done

Your Laravel admin portal now integrates with MongoDB to display scraped job listings professionally!

### ✅ Completed Setup
1. **MongoDB Package** - Installed and configured
2. **JobListing Model** - Updated to use MongoDB
3. **Professional UI** - Modern job listing views
4. **Search & Filters** - Advanced filtering system
5. **Job Details Page** - Comprehensive job information display

## 📦 Quick Start

### Step 1: Import Your Job Data

**Using PowerShell (Windows):**
```powershell
.\import-jobs.ps1 your-jobs-file.json
```

**Using Bash (Linux/Mac):**
```bash
chmod +x import-jobs.sh
./import-jobs.sh your-jobs-file.json
```

**Manual Import:**
```bash
mongoimport --db job_scraper --collection job_listings --file jobs.json --jsonArray --drop
```

### Step 2: Start Your Server
```bash
php artisan serve
```

### Step 3: Access the Portal
1. Navigate to: `http://localhost:8000/admin/jobs`
2. Login with your admin credentials
3. View and manage your job listings!

## 🎯 Features

### Job Listings Page (`/admin/jobs`)
- **Statistics Dashboard**: Total jobs, remote jobs, companies, locations
- **Search**: Find jobs by title, company, or location
- **Filters**: 
  - Job source (Indeed, LinkedIn, etc.)
  - Work type (Remote/On-site)
- **Clean Cards**: Company logos, key details, descriptions
- **Pagination**: 15 jobs per page

### Job Details Page (`/admin/jobs/{id}`)
- **Full Description**: Complete job posting
- **Company Info**: Logo, website, employees, revenue
- **Apply Links**: Direct and original URLs
- **Skills Display**: Required skills (if available)
- **Metadata**: Job ID, post date, source

## 🔧 Configuration

Your `.env` file has been updated with:
```env
MONGODB_DSN=mongodb://localhost:27017
MONGODB_DATABASE=job_scraper
```

Update these if your MongoDB is running elsewhere.

## 📊 Sample Data Structure

Your MongoDB documents should match this structure:
```json
{
  "id": "unique-job-id",
  "site": "indeed",
  "title": "Software Engineer",
  "company": "Tech Corp",
  "location": "New York, NY",
  "description": "Job description...",
  "company_logo": "https://...",
  "is_remote": false,
  "date_posted": "2026-01-02T00:00:00.000Z",
  "job_url": "https://...",
  ...
}
```

## 🎨 UI Preview

**Job Listings:**
```
┌──────────────────────────────────────────┐
│ 📋 Job Listings                         │
│ Scraped opportunities from multiple...  │
│                                          │
│ [Stats: Total | Remote | Companies...]  │
│                                          │
│ [Search & Filters Panel]                │
│                                          │
│ ┌──────────────────────────────────┐   │
│ │ 🏢 Software Engineer             │   │
│ │    Tech Corp                     │   │
│ │    📍 Location  🏠 Remote  📅...│   │
│ │    Description preview...         │   │
│ └──────────────────────────────────┘   │
│ [...more jobs...]                        │
└──────────────────────────────────────────┘
```

## 📝 Files Modified/Created

### Modified:
- ✏️ `.env` - Added MongoDB configuration
- ✏️ `config/database.php` - MongoDB connection
- ✏️ `app/Models/JobListing.php` - MongoDB model
- ✏️ `app/Http/Controllers/Admin/JobController.php` - Updated logic
- ✏️ `routes/web.php` - Updated routes

### Created:
- ✨ `resources/views/admin/jobs/index.blade.php` - Job listings view
- ✨ `resources/views/admin/jobs/show.blade.php` - Job details view
- ✨ `MONGODB_INTEGRATION_GUIDE.md` - Detailed documentation
- ✨ `import-jobs.sh` - Bash import script
- ✨ `import-jobs.ps1` - PowerShell import script

## 🐛 Troubleshooting

**"No jobs found"**
- Verify MongoDB is running: `mongosh` or MongoDB Compass
- Check data is imported: `mongosh job_scraper` then `db.job_listings.countDocuments()`
- Verify collection name is `job_listings`

**"Connection refused"**
- Ensure MongoDB is running on port 27017
- Update `MONGODB_DSN` in `.env` if using different port

**"Class 'MongoDB' not found"**
- Install MongoDB PHP extension via your PHP manager
- Verify: `php -m | grep mongodb`

## 🎉 Next Steps

1. **Import your job data** using the provided scripts
2. **Customize the UI** colors/branding if needed
3. **Add more filters** (salary range, job type, etc.)
4. **Enable exports** (CSV/Excel)
5. **Set up cron jobs** for automatic data refresh

## 📚 Documentation

For detailed information, see:
- [MONGODB_INTEGRATION_GUIDE.md](./MONGODB_INTEGRATION_GUIDE.md) - Complete integration details

## 💡 Tips

- Use MongoDB Compass for visual data browsing
- Run `php artisan cache:clear` if changes don't appear
- Check Laravel logs: `storage/logs/laravel.log`

---

**Need Help?** Check the comprehensive guide in `MONGODB_INTEGRATION_GUIDE.md`
