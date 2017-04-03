# Brafton Website Redeisgns
The following is instructions on the workflow for build clients sites.

## Step 1: Create the client repository

Follow the below step to begin your development workflow.  

- clone this repository ` git clone https://brafton@bitbucket.org/braftonclientsites/basebuild.git` to your local computer
- delete the .git folder inside the repository
- Create a new repository on bitbucket
    - Owner: "braftonclientsites"
    - Project: "sites"
    - Respository Name: {ClientName} [note: There can be no spaces]
    - Respository type: Git 
- Connect the basebuild Folder to the repository [this assumes the folder/repo name is "myclient" and my username is "bradtest" ]
    - Rename basebuild to "myclient"
    - ` cd myclient`
    - ` git init`
    - ` git add *`
    - ` git commit -m "first commit"`
    - ` git remote add origin https://bradtest@bitbucket.org/braftonclientsites/myclient`
    - ` git push origin master`

## Step : Modify repository for client
- Add required plugins to plugin folder
    - Your base includes the following plugins
        - Advanced Custom Fields: Used to create custom fields.  This plugin has been choosen due to the ability to generate a php script that automates the creation of any fields created the GUI for anyother installations that may require them.  See below for the desired workflow for this plugin
        - Brafton Wordpress Plugin: Required for brafton clients to import all brafton content from our API feed
        - Contact Form 7: Used for form creation
        - Wordpress Importer: Used to import content from one wordpress site to another
        - YOAST SEO: the best most comprehensive SEO plugin for wordpress
        - YARPP: Plugin for related post added to blog/news ect.
        - Any Mobile Theme Switcher: A plugin for developing a mobile specific theme in combination with a desktop theme
        - Wordfence: The best security plugin for wordpress
- Add your base theme to the repo under the "themes" folder
    - Your base includes the following themes for use as your base [Delete any you do not wish to use]
        - Twentysixteen [ for use as a base ]
        - renameme [ empty child theme already linked to Twentysixteen ]
        - bones [ a great theme for building sites ]
- Modify the hermes.json file
    - name: The name of this project. The client Name is what is recommended
    - repo: the name of the repository
    - global.title: The title for your wordpress site. This can be changed later via the wordpress GUI. This is just used to create your wordpress site
    - deploy.branch: the branch you plan to use for deployment
    - deploy.source: the path of your theme relative to this repository. [ Just change the themeused ]
    - deploy.target: the target for deployment [ Just change the themeused ]

## Step : Setup local dev enviorment
Regardless of your local setup you will need to setup links between your installation and this repository.  
The following instructions assumes:
1. You are using XAMPP and the xampp location is at c:\xampp\ 
2. Your htdocs folder located at c:\xampp\htdocs\ 
3. A local instance of wordpress for the "myclient" work at c:\xampp\htdocs\myclient
4. Your repository folder located at c:\mygitfolders\myclient

- Create symlink between your git repo theme and location in wp
    - ` mklink /J c:\xampp\htdocs\myclient\wp-content\themes\renameme c:\mygitfolders\myclient\themes\renameme`
- Create a symlink between your git repo plugins and location in wp
    - Delete the plugins folder from your local wp
    -  ` mklink /J c:\xampp\htdocs\myclient\wp-content\plugins c:\mygitfolders\myclient\plugins`
- You are now ready to develop locally.
> Be sure to regularly commit your changes and push to bitbucket

## Step : Add automated deployment to design.brafton.com [ the following are detailed in the deployments repository as well ]
> Note: this step should only be completed when you are ready to move to development on design.brafton.com  
  
> Push your most up to date changes to bitbucket before creating your deployment.

- if you have a copy of the 'deployments' repo pull the recent changes
    - cd into deployments folder `git pull origin master`
- If you do not already have a copy of the 'deployments' repo clone the repo
    - git clone https://{yourusername}@bitbucket.org/braftonclientsites/deployments.git
- copy the `braftonclientsites-repo.deployment.json` file and rename `braftonclientsites-{repoName}.deployment.json`
- Modify the deployment.json file for your deployment
```json
{
    "name": "Must match the name in your hermes.json file",
    "account": "braftonclientsites",
    "repo": "must match the repo name in your hermes.json file",
    "deploy": [
        {
            "tag": "must match the tag in your hermes.json file",
            "branch": "Must match the branch in your hermes.json file",
            "beforeinstall": "",
            "afterinstall": "",
            "source": "",
            "target": ""
        }
    ]
}
```
- run ` git add *`
- run ` git commit -m "adding {name of your deployment}"`
- run git push origin master
- You can now find your site at http://design.brafton.com/myclient [ This can take up to 5 minutes to deploy ]
- Everytime you make a push/merge to the desired branch your changes will be automatically deployed to the design server.

## Step : Package your site up for deploymen to the clients server.
- in the scripts/after.sh file uncomment out the following lines
```bash
cd ${GLOBAL_TARGETROOT} && wp db dump ${NAME}.sql
tar -czf ${GLOBAL_TARGETROOT}/${NAME}.tar.gz ${GLOBAL_TARGETROOT}
```
- the next time you push to bitbucket the above will create a sql dump file in the root directory of the wp site and create a zip file downloadable at http://design.brafton.com/myclient/myclient.tar.gz
- take the zip file and copy the wp-content folder into a live server running wordpress
- take the sql file and import into the clients live server running MySQL
