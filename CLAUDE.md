# TrackAttack Pro - Project Rules

## Versioning
- **Current version: v1.1**
- Version is displayed in the header bar between the logo and hamburger menu
- **After every task, bump the version number** in `index.html` (the `.version-badge` element)
  - Minor tasks (fixes, tweaks, small additions): bump sub-version (e.g. v1.1 -> v1.2)
  - Major tasks (new sections, redesigns, large features): bump major version (e.g. v1.2 -> v2.0)
- The version badge text is in the `<div class="version-badge">` element in the header

## Tech Stack
- Single-page static HTML site (index.html)
- All CSS/JS inline
- Hosted on Netlify: https://trackattack-pro.netlify.app
- GitHub repo: https://github.com/avitheret/trackattack-pro

## Deployment
- Deploy with: `npx netlify-cli deploy --prod --dir=.`
- Always commit and push to GitHub before deploying
