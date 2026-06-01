---
name: Velocity Performance
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#3a3939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1c1b1b'
  surface-container: '#201f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353534'
  on-surface: '#e5e2e1'
  on-surface-variant: '#e6bdbb'
  inverse-surface: '#e5e2e1'
  inverse-on-surface: '#313030'
  outline: '#ad8886'
  outline-variant: '#5d3f3e'
  surface-tint: '#ffb3b1'
  primary: '#ffb3b1'
  on-primary: '#680011'
  primary-container: '#e31837'
  on-primary-container: '#fffaf9'
  inverse-primary: '#bf0029'
  secondary: '#adc6ff'
  on-secondary: '#002e69'
  secondary-container: '#4b8eff'
  on-secondary-container: '#00285c'
  tertiary: '#c6c6cf'
  on-tertiary: '#2f3037'
  tertiary-container: '#72737b'
  on-tertiary-container: '#fcfaff'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffdad8'
  primary-fixed-dim: '#ffb3b1'
  on-primary-fixed: '#410007'
  on-primary-fixed-variant: '#92001d'
  secondary-fixed: '#d8e2ff'
  secondary-fixed-dim: '#adc6ff'
  on-secondary-fixed: '#001a41'
  on-secondary-fixed-variant: '#004493'
  tertiary-fixed: '#e2e1eb'
  tertiary-fixed-dim: '#c6c6cf'
  on-tertiary-fixed: '#1a1b22'
  on-tertiary-fixed-variant: '#45464e'
  background: '#131313'
  on-background: '#e5e2e1'
  surface-variant: '#353534'
typography:
  headline-xl:
    fontFamily: Anton
    fontSize: 72px
    fontWeight: '400'
    lineHeight: 72px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Anton
    fontSize: 48px
    fontWeight: '400'
    lineHeight: 48px
  headline-lg-mobile:
    fontFamily: Anton
    fontSize: 36px
    fontWeight: '400'
    lineHeight: 36px
  headline-md:
    fontFamily: Anton
    fontSize: 24px
    fontWeight: '400'
    lineHeight: 28px
  body-lg:
    fontFamily: Hanken Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Hanken Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-caps:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.1em
  data-display:
    fontFamily: JetBrains Mono
    fontSize: 20px
    fontWeight: '500'
    lineHeight: 24px
spacing:
  unit: 4px
  gutter: 24px
  margin-desktop: 64px
  margin-mobile: 20px
  container-max: 1440px
---

## Brand & Style

This design system is engineered for high-performance automotive environments. It draws heavily from **Brutalism** and **Modern Corporate** aesthetics, stripped of all unnecessary ornamentation to focus on speed, precision, and engineering excellence. The interface should feel like a high-end telemetry dashboard or a premium mechanical blueprint.

The personality is aggressive and unapologetic, utilizing high-contrast visuals to command attention. Every element must evoke the sensation of raw power under controlled management. We achieve this through:
- **Technical Precision:** Tight alignment and structured grids.
- **Kinetic Energy:** Italicized typography and directional cues.
- **Industrial Premium:** A dark-mode first approach using material-inspired textures like carbon fiber and brushed aluminum.

## Colors

The palette is anchored in **Asphalt Black** and **Deep Charcoal** to provide a high-contrast foundation that makes functional colors pop. 

- **Primary (Racing Red):** Used for critical actions, speed indicators, and brand emphasis. It represents heat, power, and urgency.
- **Secondary (Electric Blue):** Used for technical data, tuning parameters, and secondary calls to action. It represents cooling, precision, and electronics.
- **Metallic Accents:** Silver and light grays are used for borders and iconography to mimic machined metal components.
- **Surface Strategy:** Backgrounds should use a slight grain or carbon fiber pattern overlay at 5% opacity to add depth without distracting from the data.

## Typography

The typographic system is built on a "Speed/Data" dichotomy.

- **Headlines (Anton):** Always italicized and uppercase. This creates a "forward-leaning" visual effect that suggests motion even when static. 
- **Body (Hanken Grotesk):** A sharp, contemporary sans-serif used for readability in technical descriptions and product specs.
- **Data & Labels (JetBrains Mono):** A monospaced font used for technical specifications, part numbers, and telemetry data. This reinforces the engineering-focused nature of the brand.

## Layout & Spacing

This design system utilizes a **12-column fixed grid** for desktop and a **4-column fluid grid** for mobile. 

The spacing logic is built on a 4px baseline, but emphasizes generous horizontal "track" space. Gutters are kept tight (24px) to maintain a dense, technical feel. Layouts should favor asymmetrical compositions to mimic the dynamic nature of a racetrack. 

Large sections of content should be separated by heavy "impact lines" (2px to 4px thick) instead of white space alone, reinforcing the structural integrity of the layout.

## Elevation & Depth

In a high-octane dark interface, depth is created through **Tonal Layers** and **Hard Outlines** rather than soft shadows.

- **Level 0 (Track):** Pure black (#000000) for the main background.
- **Level 1 (Chassis):** Deep charcoal (#0F0F0F) for main containers and cards.
- **Level 2 (Component):** Lighter charcoal (#1A1A1A) for interactive elements.
- **Borders:** Use 1px metallic silver borders at 20% opacity to define edges. 
- **Glows:** High-priority elements (like active toggles or status lights) use a subtle outer glow of the primary red or secondary blue to simulate illuminated dashboard indicators.

## Shapes

The shape language is **Sharp (0)**. There are no rounded corners in this design system. 

Every element—buttons, cards, input fields, and tags—must have 90-degree angles. This communicates precision, structural rigidity, and a "no-nonsense" mechanical aesthetic. To add visual interest, use "clipped corners" (45-degree chamfers) on large containers or buttons to mimic the look of machined metal parts or aerodynamic bodywork.

## Components

### Buttons
- **Primary:** Solid Racing Red, sharp corners, uppercase italicized text. On hover, the background shifts to Electric Blue for a "high-voltage" feel.
- **Secondary:** Ghost style with a 2px Metallic Silver border and JetBrains Mono text.

### Inputs & Text Fields
- Dark backgrounds with a bottom-only 2px border. When focused, the border glows Racing Red. Labels are always small-caps JetBrains Mono above the field.

### Progress Bars & Gauges
- Linear, non-rounded progress bars. Use segments (like a tachometer) rather than a smooth fill. The color should transition from Blue to Red as the value increases.

### Cards
- No shadows. Use a 1px border and a subtle carbon fiber texture overlay. Headers within cards should be separated by a thin metallic line.

### Iconography
- Use ultra-thin, 1.5pt stroke icons. Lines should be sharp with no rounded caps. Every icon should feel like it was pulled from a technical assembly manual.