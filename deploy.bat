call gsutil cp "C:\Users\maxou\Dropbox\Max\Winter 2018\CSI 3540 Structures et normes du web\Project\wbproj\sql_scripts\create_cloud.sql" gs://wbproj-csi3540-dump/
call gsutil acl ch -u me7yaqszynenblqp5d36gozsyq@speckle-umbrella-pg-5.iam.gserviceaccount.com:W gs://wbproj-csi3540-dump/
call gsutil acl ch -u me7yaqszynenblqp5d36gozsyq@speckle-umbrella-pg-5.iam.gserviceaccount.com:R gs://wbproj-csi3540-dump/create_cloud.sql
call gcloud sql instances import wbprojdb gs://wbproj-csi3540-dump/create_cloud.sql --database postgres --quiet
