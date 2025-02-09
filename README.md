# Moodle Local Plugin: qiuckstats 

## Description  
This plugin is designed to test.  

## Installation Instructions  

Follow these steps to install and activate the plugin:  

1. **Copy the plugin to the Moodle `local` directory:**  
   Clone or copy the plugin folder into the following path in your Moodle installation:  
   ```
   /path/to/moodle/local/
   ```

2. **Install AMD modules**: Go to terminal, cd to local folder, run command
    ```
   grunt amd
   ```
   


2. **Log in to your Moodle site as an administrator.**
Navigate to the Site administration > Notifications page.
Moodle will detect the new plugin and prompt you to proceed with the installation. Follow the on-screen instructions to complete the process.
Purge caches at:
```
   https://yourmoodlesite.local/admin/purgecaches.php
```

3. **Access the plugin page:**
Once installed, you can access the plugin page by visiting the following URL in your browser:
```
https://yourmoodlesite.local/local/quickstats/index.php
```

