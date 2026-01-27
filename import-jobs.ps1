# MongoDB Import Script for Job Listings (PowerShell)
# This script helps you quickly import job data into MongoDB

Write-Host "==================================" -ForegroundColor Cyan
Write-Host "MongoDB Job Listings Import Tool" -ForegroundColor Cyan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""

# Configuration
$DB_NAME = "job_scraper"
$COLLECTION_NAME = "jobs_scrape"
$MONGO_HOST = "localhost"
$MONGO_PORT = "27017"

# Check if mongoimport is available
$mongoImport = Get-Command mongoimport -ErrorAction SilentlyContinue
if (-not $mongoImport) {
    Write-Host "❌ mongoimport not found. Please install MongoDB tools." -ForegroundColor Red
    Write-Host "   Download from: https://www.mongodb.com/try/download/database-tools" -ForegroundColor Yellow
    exit 1
}

Write-Host "✅ mongoimport found" -ForegroundColor Green
Write-Host ""

# Check if JSON file is provided
if ($args.Count -eq 0) {
    Write-Host "Usage: .\import-jobs.ps1 <path-to-json-file>" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Example:" -ForegroundColor Cyan
    Write-Host "  .\import-jobs.ps1 jobs_data.json" -ForegroundColor Gray
    Write-Host ""
    exit 1
}

$JSON_FILE = $args[0]

# Check if file exists
if (-not (Test-Path $JSON_FILE)) {
    Write-Host "❌ File not found: $JSON_FILE" -ForegroundColor Red
    exit 1
}

Write-Host "📁 File: $JSON_FILE" -ForegroundColor Cyan
Write-Host "🗄️  Database: $DB_NAME" -ForegroundColor Cyan
Write-Host "📦 Collection: $COLLECTION_NAME" -ForegroundColor Cyan
Write-Host ""

# Ask for confirmation
$confirmation = Read-Host "Continue with import? (y/n)"
if ($confirmation -ne 'y' -and $confirmation -ne 'Y') {
    Write-Host "❌ Import cancelled" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🚀 Starting import..." -ForegroundColor Yellow
Write-Host ""

# Run mongoimport
$importCmd = "mongoimport --host $MONGO_HOST`:$MONGO_PORT --db $DB_NAME --collection $COLLECTION_NAME --file `"$JSON_FILE`" --jsonArray --drop"

try {
    Invoke-Expression $importCmd
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host ""
        Write-Host "✅ Import completed successfully!" -ForegroundColor Green
        Write-Host ""
        
        # Show stats
        Write-Host "📊 Collection Statistics:" -ForegroundColor Cyan
        
        $mongoShell = Get-Command mongosh -ErrorAction SilentlyContinue
        if ($mongoShell) {
            $statsScript = @"
print('Total documents: ' + db.$COLLECTION_NAME.countDocuments());
print('Remote jobs: ' + db.$COLLECTION_NAME.countDocuments({is_remote: true}));
print('Sites: ' + db.$COLLECTION_NAME.distinct('site').length);
print('Companies: ' + db.$COLLECTION_NAME.distinct('company').length);
"@
            & mongosh "$MONGO_HOST`:$MONGO_PORT/$DB_NAME" --quiet --eval $statsScript
        }
        
        Write-Host ""
        Write-Host "🎉 Your job listings are ready to view at: http://localhost:8000/admin/jobs" -ForegroundColor Green
    }
    else {
        Write-Host ""
        Write-Host "❌ Import failed. Please check the error messages above." -ForegroundColor Red
        exit 1
    }
}
catch {
    Write-Host ""
    Write-Host "❌ Import failed: $_" -ForegroundColor Red
    exit 1
}
