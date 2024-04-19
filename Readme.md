## Artillery Meta 

WordPress dynamic plugin that creates a custom meta box on post page and a custom block in the site editor to display text with the custom meta box link anchor.

To run
```
npm run start
```

If you want to create another plugin easily from the `/plugins` directory run:
```
npx @wordpress/create-block@latest [plugin-name] --variant dynamic
```
cd into the new directory & run:
```
npm run start
```

Plugin created with the help of ["Creating a custom block that stores post meta" article](https://developer.wordpress.org/news/2023/03/03/creating-a-custom-block-that-stores-post-meta/).

Also [officially supported tool for scaffolding a WordPress plugin](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-create-block/).