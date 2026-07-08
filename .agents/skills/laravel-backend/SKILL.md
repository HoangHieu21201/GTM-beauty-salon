---
name: Laravel Backend Skill
description: Skill for building and modifying Laravel database structures, backend logic, and Blade views while prioritizing data integrity, security, and Laravel best practices.
---

# Laravel Backend Skill

## Purpose
This skill equips the agent to design, build, and modify Laravel backend components (Database schemas, Models, Controllers, Routes) and Blade views securely and efficiently.

## Responsibilities
- Design and implement robust Database schemas using Laravel Migrations.
- Create and configure Eloquent Models, strictly defining relationships (`hasOne`, `hasMany`, `belongsTo`), `$fillable` (mass assignment protection), and casts.
- Write clean, RESTful Controllers to handle request validation and business logic.
- Pass data cleanly to Blade templates and utilize Blade directives effectively.
- Ensure database queries are optimized, utilizing Eager Loading (`with()`) to prevent N+1 query performance issues.
- Define safe routing in `web.php` or `api.php` with proper middleware.

## Constraints
- **Naming:** Strictly follow Laravel naming conventions (e.g., Table: `users`, Model: `User`, Controller: `UserController`).
- **Querying:** Never write raw SQL queries unless absolutely necessary; always prefer Eloquent ORM or Query Builder to prevent SQL Injection.
- **Migrations:** Do not create destructive database migrations (e.g., `dropColumn`, `dropTable`) without explicit user permission. Always prefer adding new columns or soft deletes.
- **Blade Logic:** Do not put complex business logic or database queries inside Blade templates. Blade is for display only.
- **Validation:** Always validate incoming request data using `$request->validate()` or FormRequest classes before inserting into the database.
- **Modifications:** Do not remove, overwrite, or revert existing working controllers or routes unless required for the specific task.
- **Secrets:** Never expose environment secrets (`.env` variables, DB passwords, API keys) in Blade views, logs, or error messages.
- **Blade Structure:** You MUST organize views strictly into: `layouts/` for templates, `components/` for reusable `<x-` components, and `admin/pages/` or `client/pages/` for actual page contents.
- **Code Style:** Keep code clean, PSR-12 compliant, and consistent with nearby files.

## Comment Rules
- Add comments only for complex query logic or non-obvious relationships.
- Comments must be short, clear, and limited to one line.
- Use plain ASCII characters only.

## Working Approach
1. Read existing Models, Migrations, and Routes to understand the current database schema before making changes.
2. Plan the database changes (New tables? Modifying existing tables?).
3. Create the necessary Migration, Model, and Controller using `php artisan make:model -mcr` if applicable.
4. Implement the logic, ensuring data validation and mass-assignment protection.
5. Create or update the relevant Blade views to reflect the data.
6. Compare edited code with Laravel standards.
7. Run `php artisan optimize:clear` and `php artisan migrate` (if safe) to test the implementation.
8. Report what was changed, including the new routes or database tables created.

## Validation Steps
- Verify `$fillable` variables are set.
- Check for Eager Loading where relationships are used.
- Ensure all logic in Blade is minimal and strictly display-oriented.
- Run `php artisan migrate:status`.

## Success Criteria
- The database structure accurately reflects the requirements.
- Eloquent relationships work perfectly.
- Data is securely validated and saved.
- Blade templates render the data correctly without executing raw queries.
- No N+1 query issues are introduced.
- No destructive DB changes are made without consent.
