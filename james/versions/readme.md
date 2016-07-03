# Blog Tags Extension
This plugin is an extension to the [RainLab.Blog](https://github.com/rainlab/blog-plugin) plugin. This extension enables blog posts to have software versions attached.

#### Websites using Blog Tags Extension
[Panic Vault](http://pv.rotary-design.com)

If you're using it, feel free to let me know so I can showcase it here.

#### Software
Define a software package with this model

- **name** - The name of the software you're using in relation to a version

#### Versions
The `versions` model defines the actual version number of a software package you're using in relation to a blog post

- **software_id** - The ID of the software this version is for
- **version** - The version of the software

#### Usage
- Install this plugin, then add the software and version widgets to the dashboard
- Alternatively, go to "Versions" on the left side of the blog tab in the backend
- Add a software first, then a version to go with it
- Finally, in the Categories tab of a blog post you will be able to select a version for that post

#### Frontend Usage Example:

[logo]: http://puu.sh/pOCqG/a78b9ed055.png "Example"
![alt text][logo]

```twig
{% if post.versions.count %} | Using
    <span itemprop="keywords">
        {% for version in post.versions %}
            <a href="{{ version.software_id }}">{{ version.getSoftwareName() }}</a> version{% if not loop.last %}, {% endif %}
            <a href="{{ version.id }}">{{ version.version }}</a>{% if not loop.last %}, {% endif %}
        {% endfor %}
    </span>
{% endif %}
```