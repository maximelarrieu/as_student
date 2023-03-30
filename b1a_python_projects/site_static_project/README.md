# Converter Markdown to HTML
## [STUDY PROJECT] A tool that converts Markdown to HTML
---
A tool that converts a directory of markdown files and images into another directory containing the HTML files. HTML will be generated from the markdown.

### Command line interface

Different commands are at your service :

```python3 executable.py --input-directory (or '-i') markedown_files/``` to know the path of markdown files directory

```python3 executable.py --output-directory (or '-o') html_files/``` to know the path of converted html files directory

```python3 executable.py --template-directory (or '-t') template_files/``` to know the path of templates files directory

and the only one :
```python3 executable.py --help (or '-h')``` allows you to display the help menu where you will find all the commands

*My command line internace is not working, you can check the `--help` command.*

### So, how to use this script ?

*My bad :( I didn't success to use command line*

Put your files to be converted in the folder `markdown_files`.

To use my script you need to modify the script.
Use `nano main.py` or other IDE to open the `main.py` file.

Modify targets in line L11 and L12.

`L11 input_file = markdown_files + 'your_file.md'`
`L12 output_file = html_files + 'your_new_file.html'`

and run

`$ python3 main.py`

