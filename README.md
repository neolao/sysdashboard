SysDashboard
============

A dashboard for metrics.


Installation
------------

```bash
npm install -g sysdashboard
sysdashboard board:create myboard
cd myboard
sysdashboard start 3333
```

Widget
------
A widget displays something: a number, a graph, an image, etc.

Create a new widget:

```bash
cd path/to/myboard
sysdashboard widget:create number
```

This command returns an ID. You can customize the widget here: `path/to/myboard/widgets/{id}/`.

Get the list of available types:

```bash
sysdashboard widget:types
```

Layout
------
The widgets are displayed on a layout.

Create a new layout:

```bash
cd path/to/myboard
sysdashboard layout:create single --add-widget {id}
```

Get the list of available types:

```bash
sysdashboard layout:types
```


Screen
------
By default, the website displays the first screen with the first layout.

You can change the layout of the screen via the menu or the API.

Create a new screen:

```bash
cd path/to/myboard
sysdashboard screen:create {id}
```

You have an access to the screen with the URL: `http://myboard/screen/{id}`

A screen is synchronized to all the browers that display the screen.


Worker
------
A worker is used to collect and/or store data in order to update widgets.
It is an optional feature to extend the board automation.

The worker can change the screens and widgets appearance.

Create a new worker:

```bash
cd path/to/myboard
sysdashboard worker:create
```
This command returns an ID. You can customize the worker here: `path/to/myboard/workers/{id}/`.


API
---

- Change the layout of a screen
- Update the data of a widget
- Send data to a worker


More ?
------

- Create a new type of widget
- Create a new type of layout

