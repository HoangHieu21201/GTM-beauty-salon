# Task: Build Product Categories System

## 1. Context & Objective
We need a database structure to handle Product Categories for our e-commerce site. Categories should have a name, a slug, and a description. We also need a basic backend interface (Blade) to list these categories.
**Goal:** Create the Migration, Model, Controller, and an index Blade view for Categories securely and following Laravel conventions.

## 2. To-Do List
- [ ] Create a migration for the categories table (id, name, slug, description, timestamps).
- [ ] Create the Category Eloquent Model with `$fillable` fields defined.
- [ ] Create a CategoryController with an index method to fetch all categories.
- [ ] Register a GET route `/categories` in `routes/web.php` pointing to the controller.
- [ ] Create a Blade view `resources/views/categories/index.blade.php` to display the list of categories in a simple HTML table.
- [ ] Ensure no N+1 query issues (though simple here, keep it in mind for future relationships).

## 3. Strict Constraints & Rules
- **Agent Skill:** You MUST strictly follow the rules defined in `.agents/skills/laravel-backend/SKILL.md`.
- **Security:** Ensure `$fillable` is strictly defined in the Model.
- **Convention:** Use standard Laravel naming (`Category`, `categories`, `CategoryController`).
- **Blade Logic:** Do NOT query the database inside `index.blade.php`. Pass the `$categories` collection from the controller.
- **Validation:** Mark the checkboxes above with `[x]` as you complete them.
