#!/usr/bin/python3

import argparse
import markdown
import codecs
import re
import os

markdown_folder = 'markdown_files/'
html_folder = 'html_files/'
input_file = markdown_folder + 'test2.md'
output_file = html_folder + 'index0.html'

def to_Html(markdown_file, html_file):
    md_file = codecs.open(markdown_file, 'r')
    body = md_file.read()
    html = markdown.markdown(body)
    head_html_file = open(head_html, 'r')
    read_html_head = head_html_file.read()
    end_html_file = open(end_html, 'r')
    read_html_end = end_html_file.read()
    html_file = open(html_file, 'w')
    html_file.write(read_html_head)
    html_file.write(html + '\n')
    html_file.write(read_html_end)
    html_file.close()

head_html = 'html_files/head.html'
end_html = 'html_files/end.html'

parser = argparse.ArgumentParser(description="Convertisseur fichier markdown en fichier html")
input_directory = '--input-directory'
output_directory = '--output-directory'
template_directory = '--template-directory'

parser.add_argument( '--input', input_directory, help="sources files folder (contains markdown files)", action="store_true")
parser.add_argument('-output', output_directory, help="final folder where files will be generated", action="store_true")
parser.add_argument('-t', template_directory, help="folder containing web models to complete", action="store_true")
args = parser.parse_args()

to_Html(input_file, output_file)
