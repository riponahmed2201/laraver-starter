# Database Design

1. `Module`

    - id
    - name

2. `Permission`

    - id
    - module_id
    - name
    - slug

3. `PermissionRole`

    - id
    - permission_id

4. `Role`

    - id
    - name
    - slug
    - note
    - deletable

5. `User`

    - id
    - role_id
    - name
    - email
    - password
    - status

6. `Menu`

    - id
    - name
    - description
    - deletable

7. `MenuItem`

    - id
    - menu_id
    - parent_id
    - order
    - title
    - url
    - target
    - icon_class

8. `Page`

    - id
    - title
    - slug
    - excerpt
    - body
    - meta_description
    - meta_keywords
    - status

9. `Setting`
    - id
    - name
    - value
