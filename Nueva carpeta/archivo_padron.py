import pdfplumber

# Ruta al archivo PDF
file_path = 'archivo.pdf'

# Abre el archivo PDF
with pdfplumber.open(file_path) as pdf:
    # Resto del código para trabajar con el PDF
    # ...

    # Itera a través de cada página
    for page in pdf.pages:
        # Extrae el texto de la página actual
        text = page.extract_text()
        
        # Imprime el texto de la página actual
        print(f"Texto en la página {page.page_number}:\n{text}\n")
