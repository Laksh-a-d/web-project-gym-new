import cv2
import numpy as np
import tkinter as tk
from tkinter import filedialog, ttk, messagebox
from PIL import Image, ImageTk
import os

file_path = ""  # Global variable to store the file path


def display_image_tk(image, container):
    try:
        # Clear existing image label if it exists
        for widget in container.winfo_children():
            if isinstance(widget, tk.Label):
                widget.destroy()

        image_pil = Image.fromarray(cv2.cvtColor(image, cv2.COLOR_BGR2RGB))
        container_width = container.winfo_width()
        container_height = container.winfo_height()

        # Resize the image to fit within the container
        image_pil.thumbnail((container_width, container_height), Image.ANTIALIAS)

        photo = ImageTk.PhotoImage(image=image_pil)
        label = tk.Label(container, image=photo)
        label.image = photo
        label.pack(side=tk.TOP, padx=10, pady=10)
        container.photo = photo
    except Exception as e:
        messagebox.showerror("Error", f"Error occurred while displaying image: {e}")


def apply_filters_and_display(root):
    global file_path  # Declare file_path as global
    try:
        file_path = filedialog.askopenfilename()
        if file_path:
            original_image = cv2.imread(file_path)
            gray_image = cv2.cvtColor(original_image, cv2.COLOR_BGR2GRAY)
            smoothed_image = cv2.GaussianBlur(gray_image, (0, 0), 5)
            _, binary_image = cv2.threshold(smoothed_image, 127, 255, cv2.THRESH_BINARY)
            num_labels, labels, stats, centroids = cv2.connectedComponentsWithStats(
                binary_image, connectivity=8
            )
            for i in range(1, num_labels):
                if stats[i, cv2.CC_STAT_AREA] < 30000:
                    binary_image[labels == i] = 0
            transposed_image = cv2.transpose(binary_image)
            (
                num_labels_transposed,
                labels_transposed,
                stats_transposed,
                centroids_transposed,
            ) = cv2.connectedComponentsWithStats(transposed_image, connectivity=8)
            for i in range(1, num_labels_transposed):
                if stats_transposed[i, cv2.CC_STAT_AREA] < 2000:
                    transposed_image[labels_transposed == i] = 0
            final_image = cv2.transpose(transposed_image)
            edges = cv2.Canny(final_image, 100, 200)
            kernel = np.ones((5, 5), np.uint8)
            dilated_image = cv2.dilate(edges, kernel, iterations=1)

            # Update images in containers
            display_image_tk(original_image, container1)
            display_image_tk(gray_image, container2)
            display_image_tk(smoothed_image, container3)
            display_image_tk(binary_image, container4)
            display_image_tk(final_image, container5)
            display_image_tk(edges, container6)
            display_image_tk(dilated_image, container7)

            # Store images for downloading
            global images_for_download
            images_for_download = {
                "Original_Image": original_image,
                "Grayscale_Image": gray_image,
                "Smoothed_Image": smoothed_image,
                "Binary_Image": binary_image,
                "Final_Image": final_image,
                "Edged_Image": edges,
                "Dilated_Image": dilated_image,
            }
    except Exception as e:
        messagebox.showerror(
            "Error", f"Error occurred while applying filters and displaying images: {e}"
        )


def download_image(image_name, image, suffix):
    try:
        image_pil = Image.fromarray(cv2.cvtColor(image, cv2.COLOR_BGR2RGB))
        image_path = os.path.join(
            os.path.expanduser("~"), "Downloads", f"{image_name}_{suffix}.png"
        )
        image_pil.save(image_path)
    except Exception as e:
        messagebox.showerror("Error", f"Error occurred while downloading image: {e}")


def download_all_images():
    global file_path  # Access the global file_path
    if "images_for_download" in globals():
        try:
            file_name = os.path.basename(file_path).split(".")[
                0
            ]  # Extracting the uploaded file name
            for image_name, image in images_for_download.items():
                image_type = image_name.split("_")[0]  # Extracting the image type
                download_image(
                    f"{file_name}{image_type}{('_')[-1]}",
                    image,
                    image_name.split("_")[-1],
                )  # Modified file name

            messagebox.showinfo("Download Successful", "All images saved successfully!")
        except Exception as e:
            messagebox.showerror(
                "Error", f"Error occurred while downloading images: {e}"
            )
    else:
        messagebox.showwarning("No Images", "No images available for download.")


root = tk.Tk()
root.title("Edge Detector")
root.geometry("1920x1080")
root.config(bg="#FBEEC1")

header_label = tk.Label(
    root,
    text="Jawaharlal Nehru Aluminum Research Development and Design Centre, Nagpur",
    font=("Times New Roman", 30, "bold"),  # Larger, bold font
    bg="#0077cc",  # Blue background
    fg="white",  # White text
)
header_label.pack(fill=tk.X)

upload_button = tk.Button(
    root,
    text="Upload and Apply Filters",
    command=lambda: apply_filters_and_display(root),
    bg="#0077cc",
    fg="white",
    font=("Times New Roman", 14, "bold"),
)
upload_button.pack(
    side=tk.TOP, pady=(20, 30)
)  # Increase top padding to 20 and bottom padding to 30

download_button = tk.Button(
    root,
    text="Download All",
    command=download_all_images,
    bg="#0077cc",
    fg="white",
    font=("Times New Roman", 12, "bold"),
)
download_button.pack(side=tk.TOP, pady=(0, 10))  # Add padding

# Create a frame with a custom background color for the central area
center_frame = tk.Frame(root, bg="#FBEEC1")
center_frame.pack(fill=tk.BOTH, expand=True)

# Create canvas and scrollbar inside the central frame
canvas = tk.Canvas(center_frame, bg="#FBEEC1")
canvas.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)

scrollbar = ttk.Scrollbar(center_frame, orient=tk.VERTICAL, command=canvas.yview)
scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

canvas.configure(yscrollcommand=scrollbar.set)
canvas.bind("<Configure>", lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
canvas.bind_all(
    "<MouseWheel>", lambda e: canvas.yview_scroll(-1 * int(e.delta / 120), "units")
)

# Create a frame inside the canvas to contain other frames (containers)
frame = tk.Frame(canvas, bg="#FBEEC1")
canvas.create_window((0, 0), window=frame, anchor="nw")

label1 = tk.Label(
    frame, text="1. Original Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label1.pack(side=tk.TOP, anchor="w", padx=20, pady=(10, 2), fill="x")
container1 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container1.pack_propagate(False)
container1.pack(
    side=tk.TOP, padx=10, pady=(2, 20), anchor="w", fill="both", expand=True
)

label2 = tk.Label(
    frame, text="2. Grayscale Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label2.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 2), fill="x")
container2 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container2.pack_propagate(False)
container2.pack(side=tk.TOP, padx=10, pady=(2, 2), anchor="w", fill="both", expand=True)

label3 = tk.Label(
    frame, text="3. Smoothed Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label3.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 2), fill="x")
container3 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container3.pack_propagate(False)
container3.pack(side=tk.TOP, padx=10, pady=(2, 2), anchor="w", fill="both", expand=True)

label4 = tk.Label(
    frame, text="4. Binary Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label4.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 2), fill="x")
container4 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container4.pack_propagate(False)
container4.pack(side=tk.TOP, padx=10, pady=(2, 2), anchor="w", fill="both", expand=True)

label5 = tk.Label(
    frame, text="5. Final Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label5.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 2), fill="x")
container5 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container5.pack_propagate(False)
container5.pack(side=tk.TOP, padx=10, pady=(2, 2), anchor="w", fill="both", expand=True)

label6 = tk.Label(
    frame, text="6. Edged Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label6.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 2), fill="x")
container6 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container6.pack_propagate(False)
container6.pack(side=tk.TOP, padx=10, pady=(2, 2), anchor="w", fill="both", expand=True)

label7 = tk.Label(
    frame, text="7. Dilated Image", font=("Times New Roman", 20, "bold"), bg="#FBEEC1"
)
label7.pack(side=tk.TOP, anchor="w", padx=20, pady=(2, 20), fill="x")
container7 = tk.Frame(
    frame, width=900, height=600, bg="#ffffff", borderwidth=2, relief="groove"
)
container7.pack_propagate(False)
container7.pack(
    side=tk.TOP, padx=10, pady=(2, 20), anchor="w", fill="both", expand=True
)

root.mainloop()