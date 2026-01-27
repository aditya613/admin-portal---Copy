#!/bin/bash

# MongoDB Import Script for Job Listings
# This script helps you quickly import job data into MongoDB

echo "=================================="
echo "MongoDB Job Listings Import Tool"
echo "=================================="
echo ""

# Configuration
DB_NAME="job_scraper"
COLLECTION_NAME="job_listings"
MONGO_HOST="localhost"
MONGO_PORT="27017"

# Check if mongoimport is available
if ! command -v mongoimport &> /dev/null
then
    echo "❌ mongoimport not found. Please install MongoDB tools."
    echo "   Download from: https://www.mongodb.com/try/download/database-tools"
    exit 1
fi

echo "✅ mongoimport found"
echo ""

# Check if JSON file is provided
if [ -z "$1" ]; then
    echo "Usage: ./import-jobs.sh <path-to-json-file>"
    echo ""
    echo "Example:"
    echo "  ./import-jobs.sh jobs_data.json"
    echo ""
    exit 1
fi

JSON_FILE="$1"

# Check if file exists
if [ ! -f "$JSON_FILE" ]; then
    echo "❌ File not found: $JSON_FILE"
    exit 1
fi

echo "📁 File: $JSON_FILE"
echo "🗄️  Database: $DB_NAME"
echo "📦 Collection: $COLLECTION_NAME"
echo ""

# Ask for confirmation
read -p "Continue with import? (y/n) " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo "❌ Import cancelled"
    exit 1
fi

echo ""
echo "🚀 Starting import..."
echo ""

# Run mongoimport
mongoimport \
    --host "$MONGO_HOST:$MONGO_PORT" \
    --db "$DB_NAME" \
    --collection "$COLLECTION_NAME" \
    --file "$JSON_FILE" \
    --jsonArray \
    --drop

# Check if import was successful
if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Import completed successfully!"
    echo ""
    
    # Show stats
    echo "📊 Collection Statistics:"
    mongosh "$MONGO_HOST:$MONGO_PORT/$DB_NAME" --quiet --eval "
        print('Total documents: ' + db.$COLLECTION_NAME.countDocuments());
        print('Remote jobs: ' + db.$COLLECTION_NAME.countDocuments({is_remote: true}));
        print('Sites: ' + db.$COLLECTION_NAME.distinct('site').length);
        print('Companies: ' + db.$COLLECTION_NAME.distinct('company').length);
    "
    echo ""
    echo "🎉 Your job listings are ready to view at: http://localhost:8000/admin/jobs"
else
    echo ""
    echo "❌ Import failed. Please check the error messages above."
    exit 1
fi
