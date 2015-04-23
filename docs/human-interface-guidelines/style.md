# Style {#style}

elementary Icons have a distinctive visual style that is inspired in part by the [Tango Icons](http://tango.freedesktop.org/Tango_Desktop_Project). Icons on elementary share several common design elements.

## Design Elements {#design-elements}

### Shape {#shape}

Icons should have a distinctive shape/silhouette to improve recognition. The shape should not be too complicated, but not every icon should be a rounded rectangle.

### Outline {#outline}

All elementary Icons, and shapes within the icons, are stroked with a thin outline to improve contrast. At low resolutions the stroke size is 1px. The stroke should _not_ scale along with the icon, it should remain 1px.

The color of the outline is a dark variant of the key color of the icon. This is done by creating a stroke at 30% opacity of black such that the border of the background lines up at half pixels. This is what allows icons with a stroke to appear sharp on dark backgrounds as well as light ones.

### Highlights {#highlights}

The edges of objects tend to reflect light more due to the fact the position of the observer relative to the light source is almost always ideal for the reflection. We produce a subtle second inner outline of the object as a highlight. This stroke is very subtle and may not be apparent on some matte objects.

### Limited glossy reflections {#limited-glossy-reflections}

Use glossy reflection only on objects that have a reflective surface in real life (plastic, glass, some metal, et cetera). A sheet of paper should not be glossy.

## Lighting and Perspective {#lighting-and-perspective}

elementary Icons have a consistent light source and perspective to keep a similar look throughout the system. The icons have been designed with the UI theme in mind, meaning everything shares a cohesive feel and a subtle amount of realism.

### Lighting {#lighting}

Icons are lit from above. Items may produce a small, fuzzy shadow toward the bottom of the icon as if the icon is sitting on a shelf facing the user.

### Perspective {#perspective}

Icons should have the perspective of looking at an object on a shelf at eye level. This means the icons are front-on, not from above and not tilted to the side. This also has an effect of giving icons slightly less depth than their real-world counterparts.

------------------

_Portions of this page have been adapted from the_ [_Tango Icon Theme Guidelines_](http://tango.freedesktop.org/Tango_Icon_Theme_Guidelines)_._

#### Next Page: [Size and Alignment](/docs/human-interface-guidelines/size-and-alignment) {.text-right}
