# Code Style {#code-style}

The purpose of this guide is to provide clean and accurate instructions on
writing good code across all elementary projects. This guideline is to be
followed on every file, in order to keep our code consistent and readable. We
are also inheriting some of the GNOME's Vala guidelines to keep our code
consistent with other Vala programs.

If the guidelines here proposed are followed, newcomers to elementary
development will be more easily able to join the development and
understand code. Besides, it'll make it easier for all developers to work on
applications that they don't usually work on, because the code will be
consistent. Finally, as Guido Van Rossum said - "Code is much more often read
than written", so having nicely written code is crucial.

## Disclaimer {#disclaimer}

This guide is not finished, but has been discussed and partially approved by
the elementary contributors. It is subject to changes in the near future.

## 1. Whitespace {#whitespace}

There is no trailing whitespace at the end of a line, whether it's empty or
not. There is also no empty line after declaring a function:


    public string get_text () {
        string text = search_entry.get_text ();
        return text;
    }

White space comes before opening parentheses:


    public string get_text () {}
    if (a == 5) return 4;
    for (i = 0; i < maximum; i++) {}
    my_function_name ();
    Object my_instance = new Object ();

Whitespace goes in all maths-related code, between numbers and operators.


    c = n * 2 + 4;

## 2. Indentation {#indentation}

Vala code is indented using 4 spaces for consistency and readability.

In classes, functions, loops and general flow control, the first parentheses
is on the end of the first line ("One True Brace Style"), followed by the
indented code, and a line closing the function with a curly bracket:


    public int my_function (int a, string b, long c, int d, int e) {
        if (a == 5) {
            b = 3;
            c += 2;
            return d;
        }

        return e;
    }

On conditionals and loops, if there's only one line of code, no braces are
used:


    if (my_var > 2)
        print ("hello\n");

Cuddled else and else if:


    if (a == 4) {
        b = 1;
        print ("Yay");
    } else if (a == 3) {
        b = 3;
        print ("Not so good...");
    } else {
        b = 5;
        print ("Terrible!");
    }

## 3. Classes and files {#classes-and-files}

Only having one class per file is recommended.

All files have the same name of the class in them.

Separate code into classes for easier extensibility.

## 4. Comments {#comments}

Comments are either on the same line as the code or in a special line.

Comments are indented alongside the code, and obvious comments do more harm
than good.


    /* User chose number five */
    if (a == 5) {
        B = 4;           // Update value of b
        c = 0;           // No need for c to be positive
        l = n * 2 + 4;   // Clear l variable
    }

## 5. Variable names, class names, function names {#variable-names-class-names-function-names}


    my_variable = 5;     // Variable names
    MyClass              // Class names
    my_function_name (); // Type/Function/Method names
    MY_C     // Constants are all caps with underscores

    /* For enum members, all uppercase and underscores */
    enum OperatingSystem { // An enum name is the same as ClassesNames
        UBUNTU,
        ELEMENTARY_OS,
        VERY_LONG_OS_NAME
    }

Also worth referring that there should be no Hungarian notation, and no mix of
any kinds of notations.

## 6. Vala namespaces {#vala-namespaces}

Referring to GLib is not necessary. If you want to print something:

    GLib.print ("Hello World");
    print ("Hello World");

Opt for the second one, it's much cleaner.

## 7. Columns per line {#columns-per-line}

Ideally, lines should have no more than 80 characters per line, because this
is the default terminal size. However, as an exception, more characters could
be added, because most people have wide-enough monitors nowadays. The hard
limit is 120 characters.

## 8. GPL Header {#gpl-header}

    /***
      Copyright (C) 2011-2012 Application Name Developers
      This program is free software: you can redistribute it and/or modify it
      under the terms of the GNU Lesser General Public License version 3, as published
      by the Free Software Foundation.

      This program is distributed in the hope that it will be useful, but
      WITHOUT ANY WARRANTY; without even the implied warranties of
      MERCHANTABILITY, SATISFACTORY QUALITY, or FITNESS FOR A PARTICULAR
      PURPOSE. See the GNU General Public License for more details.

      You should have received a copy of the GNU General Public License along
      with this program. If not, see
    ***/

#### Next Page: [Reporting Bugs](/docs/code/reporting-bugs) {.text-right}