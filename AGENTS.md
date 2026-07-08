# Project Agents

## Available Agent / Skill Metadata

This project uses agent metadata to describe focused coding assistants for specific parts of the codebase. Agents should respect the existing project structure, Laravel conventions, database constraints, and current security best practices.

Related metadata files:

- `.agent.md` defines the Laravel DB & Backend Agent manifest.
- `.instructions.md` defines behavior rules for the agent.
- `.prompt.md` provides reusable prompt templates.
- `.agents/skills/laravel-backend/SKILL.md` defines the Laravel backend skill.

## Laravel DB & Backend Agent

- **Agent name:** Laravel DB & Backend Agent
- **Purpose:** Design database schemas, write Laravel migrations, create Eloquent models, build controllers, and render Blade views while strictly adhering to Laravel conventions and security best practices.
- **Target folder:** `app/`, `database/`, `resources/views/`, `routes/`
- **Focus areas:** Database schemas, Migrations, Eloquent Models, Controllers, RESTful APIs, routing, and Blade templates.

This agent is intended for backend architecture and frontend rendering logic. It should improve data integrity, ensure security (preventing SQL injections and mass-assignment vulnerabilities), optimize queries to avoid N+1 issues, and keep complex logic out of Blade templates.
