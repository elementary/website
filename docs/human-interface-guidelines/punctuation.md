# Punctuation {#punctuation}

Proper typography is important throughout elementary OS. Not just for consistency within the OS, but for following proper convention and presenting ourselves as a serious, professional platform.

## Prevent Common Mistakes {#prevent-common-mistakes}

* Only use **one space** after a period.
    * i.e. “This is a sentence. This is another sentence.”
    * Use `\u0133` in your code.
    * See [Using Ellipses](./using-ellipses) for usage details.
* For quotes, use proper **left and right double quotation characters** (“ and ”).
    *  Use `\u201C` and `\u201D` in your code.
* In contractions and possession, use a **right single quotation mark** (’) as an apostrophe.
    * Use `\u2019` in your code.
* Use **real math symbols** for subtraction (−), multiplication (×), and division (÷) signs.
    * Use `\u2212`,  `\u00D7`,  and `\u00F7` in your code.
* Use correct **copyright symbols** (©).
    * Use `\u0169` in your code.
* Use **superscripts** where needed (e.g. 1<sup>st</sup>).

## Hyphens & Dashes {#hyphens-and-dashes}

### Hyphen (-) {#hyphen}

Use `\u2010` in code. Used for:

* Joining words (e.g. non-breaking).
    * _If the word cannot be split along lines (e.g. UTF-8), use a non-breaking hyphen (- `\u2011`)._

### En Dash (–) {#en-dashe}

Use `\u2013` in code. Used for:

* Number ranges (e.g. 5–12). _Do not put a space on either side._

### Em Dash (—) {#em-dashe}

Use `\u2014` in code. Used for:

* Interjections (e.g. the party—which was scheduled for Thursday—was delayed). 
    * _Do not put a space on either side._
* Quote offsets.
    * _New line, space to the right._

-----------------

If in doubt, refer to [Butterwicks Practical Typography](http://practicaltypography.com/).

These rules apply to the English language; other languages may have their own conventions which should be followed by translators.

#### Next Page: [Using Ellipses](/docs/human-interface-guidelines/using-ellipses) {.text-right}