# Project Context

## Design System
This project uses a design system defined in `DESIGN.md` at the project root.

Always refer to this file when generating or modifying any UI component.

- Use only colors, fonts, and spacing values defined in DESIGN.md
- Do not invent new values or use defaults
- Check DESIGN.md before creating any new component

## Versioning
- **Current version: v4.0**
- Version is displayed in the header bar between the logo and hamburger menu
- **After every task, bump the version number** in `index.html` (the `.version-badge` element) AND update this file
  - Minor tasks (fixes, tweaks, small additions): bump sub-version (e.g. v2.0 -> v2.1)
  - Major tasks (new sections, redesigns, large features): bump major version (e.g. v2.1 -> v3.0)

## Tech Stack
- Single-page static HTML site (index.html)
- All CSS/JS inline
- Hosted on Netlify: https://trackattack-pro.netlify.app
- GitHub repo: https://github.com/avitheret/trackattack-pro

## Deployment
- Deploy with: `npx netlify-cli deploy --prod --dir=.`
- Always commit and push to GitHub before deploying
