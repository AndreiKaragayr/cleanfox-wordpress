# cleanfox-wordpress

CleanFox house cleaning - it's cleaning company focused on cleaning houses in Jacksonville Florida US

## Steck:

#### 1 Docker desktop install

1. download DEB package
   https://docs.docker.com/desktop/install/ubuntu/
2. install
   https://docs.docker.com/engine/install/ubuntu/

- for pkg in docker.io docker-doc docker-compose docker-compose-v2 podman-docker containerd runc; do sudo apt-get remove $pkg; done
- `sudo apt-get update`
- `sudo apt-get install ca-certificates curl`
- `sudo install -m 0755 -d /etc/apt/keyrings`
- `sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc`
- `sudo chmod a+r /etc/apt/keyrings/docker.asc`
- echo \
   "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
   $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
- `sudo tee /etc/apt/sources.list.d/docker.list > /dev/null`
- `sudo apt-get update`
- `sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin`
- `sudo docker run hello-world`

#### 2 Docker up

1. Create backend/docker-compose.yml
2. Create backend/wordpress/compose.json
3. in folder with docker-compose.yml file run:

- `docker-compose up`
- or `docker-compose -f backend/docker-compose.yml up`
- or `docker-compose up -d`

4. run docker container in docket-desktop
5. open localhost:8000
6. You can remove lock folder:

- `sudo chmod 777 -v ./folderName`
  or update all inside folder:
- `sudo chmod 777 -R ./`

#### 3 MySQL

if phpmyadmin not available:
https://www.youtube.com/watch?v=tJb5HjUuQzE

#### 4 Next js

1. create folder frontend
2. `yarn create next-app`
3. you can use NVM to switch node version

#### 5 VS Code Eslint

- setting.json

```
{
  "typescript.updateImportsOnFileMove.enabled": "never",
  "workbench.colorTheme": "One Monokai",
  "workbench.iconTheme": "Monokai Pro Icons",
  "emmet.includeLanguages": {
    "javascript": "javascriptreact"
  },
  "eslint.format.enable": true,
  "eslint.alwaysShowStatus": true,
  "files.autoSave": "onFocusChange",
  "editor.defaultFormatter": "esbenp.prettier-vscode",
  "editor.tabSize": 2,
  "editor.formatOnSave": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": "explicit"
  }
}
```

#### 6 TypeScript Generation

GraphQL Code Generator

- In the WordPress admin sidebar of your local environment, head to `GraphQL > Settings`. Make sure the `Enable Public Introspection` option is checked.
- `yarn add @graphql-codegen/cli -D`
- `yarn add @graphql-codegen/typescript -D`
- `yarn add @parcel/watcher -D`
- `npx graphql-code-generator init`
- add command to packege.json
  `"generate": "graphql-codegen --config codegen.ts"`
  instruction: https://www.youtube.com/watch?v=74JkP9CUWiI&t=243s

#### 7 Deploy Vercel

https://vercel.com/guides/wordpress-with-vercel

<abbr title="Setting DNS ">Setting DNS Namecheap</abbr>
[Namecheap](https://www.namecheap.com/support/knowledgebase/article.aspx/9837/46/how-to-connect-a-domain-to-a-server-or-hosting/#hostingwus)

[Custom Domain Vercel](https://vercel.com/docs/projects/domains/add-a-domain)


#### 8 Wordpress

[Template Wordpress](https://templatekit.jegtheme.com/cleanary/)

- Appearance Menu.

Adding the following to your theme's functions.php file:

````function register_my_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer'  => __('Footer Menu'),
    ));
}
add_action('after_setup_theme', 'register_my_menus');```
````

- Check WordPress WPGraphQL Settings
  By default, the WPGraphQL plugin should allow introspection queries. However, if introspection is disabled, you might need to enable it.

  Enable Introspection in WPGraphQL:

  1. Access your WordPress admin dashboard.
  2. Go to GraphQL Settings under GraphQL in the WordPress admin sidebar.
  3. Look for the option to disable or enable introspection queries.
  4. **Enable introspection queries** if it’s disabled.

If there’s no UI for this in the settings, you can also enable it via a filter in your theme’s functions.php file or a custom plugin.

Add the following code to functions.php (inside your theme):
`add_filter( 'graphql_enable_introspection', '__return_true' );`
