# Major Images Directory

This directory contains images for different medical specialties/majors.

## How it works:

1. When creating a new doctor, you can upload an image for their specialty
2. The image will be saved with a filename based on the major name (sanitized)
3. For example: "Cardiology" becomes "cardiology.jpg"
4. If no image is uploaded, the system will use the default "major.jpg" image

## Image naming convention:

- Major names are converted to lowercase
- Special characters are replaced with underscores
- File extension is preserved from the uploaded file

## Supported formats:

- JPG/JPEG
- PNG
- GIF

## Examples:

- "Cardiology" → cardiology.jpg
- "Internal Medicine" → internal_medicine.jpg
- "Pediatrics" → pediatrics.png
