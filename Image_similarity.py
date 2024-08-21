#!/usr/bin/env python

# Imports PIL module 
from PIL import Image
import numpy as np
import pandas as pd
import sys, json

#color legend index
color_legends = np.array( [ [255, 255, 255],    #white
                 [192, 192, 192],     #silver
                 [128, 128, 128],     #gray
                 [0,   0,   0],       #black  
                 [255, 0,   0],       #red
                 [128, 0,   0],       #maroon
                 [255, 255, 0],       #yellow
                 [128, 128, 0],       #olive
                 [0,   255, 0],       #lime
                 [0,   128, 0],       #green
                 [0,   255, 255],     #aqua
                 [0,   128, 128],     #teal
                 [0,   0,   255],     #blue
                 [0,   0,   128],     #navy
                 [255, 0,   255],     #fuchsia
                 [128, 0,   128] ] )   #purple     

def get_similarity(im1, im2):
    
    # Size of the image1 in pixels 
    width1, height1, _= im1.shape
    
    # Size of the image2 in pixels 
    width2, height2, _= im2.shape    
    
    width = min(width1, width2)
    height = min(height1, height2)
    
    sim_im = np.zeros((width, height))  
    
    for i in range(width):
        for j in range(height):
            
            im1_RGB = im1[i, j, :]
           
            
            #eucleadian distance            
            dist1 = np.sqrt((im1_RGB[0]- color_legends[:, 0])**2 +
                         (im1_RGB[1] - color_legends[:, 1])**2 + (im1_RGB[2] - color_legends[:, 2])**2)
            
            n1 = np.argmin(dist1) #index of color legend for image 1
            
            im2_RGB = im2[i, j, :]
            
            
            #eucleadian distance            
            dist2 = np.sqrt((im2_RGB[0]- color_legends[:, 0])**2 +
                         (im2_RGB[1] - color_legends[:, 1])**2 + (im2_RGB[2] - color_legends[:, 2])**2)
            
            n2 = np.argmin(dist2) #index of color legend for image 2
            
            
            sim_im[i, j] = n1 - n2
            
    overall_similarity = np.mean(np.mean(np.abs(np.abs(sim_im))))        
    
    return sim_im, overall_similarity


def similarity(im1, im2):
    
    inx =3
    
    overall_similarity_ar1 = np.zeros((inx, inx)) 
    overall_similarity_ar2 = np.zeros((inx, inx))
    
     #find align 
    for i in range(inx):
        for j in range(inx):
            _, overall_similarity1 = get_similarity(im1[i:,j:,:], im2)
            overall_similarity_ar1[i,j] = overall_similarity1
            
            _, overall_similarity2 = get_similarity(im1, im2[i:, j:,:])
            overall_similarity_ar2[i,j] = overall_similarity2
            
            
    A1 = overall_similarity_ar1
    A2 = overall_similarity_ar2
    
    if A1.argmin() < A2.argmin():
        
        r1, c1 = A1.argmin()//A1.shape[1], A1.argmin()%A1.shape[1]
        
        sim_im, _ = get_similarity(im1[r1:,c1::,:], im2)
        
    else:

        r2, c2 = A2.argmin()//A2.shape[1], A2.argmin()%A2.shape[1]   
        sim_im, _ = get_similarity(im1, im2[r2:, c2:,:])
   
    
    return sim_im


def main(first_image, second_image):

                 
    # open first images as RGB mode
    im1 = Image.open(first_image) 
     
    im1 = np.asarray(im1)
    
    # open second images as RGB mode
    im2 = Image.open(second_image) 
        
    im2 = np.asarray(im2)
    
   
    
    
    #similarity
    sim_ar_score = similarity(im1, im2)
    sim_ar = sim_ar_score.astype(np.float64)*10
    
    sim_ar = (sim_ar- np.min(sim_ar))/(np.max(sim_ar)- np.min(sim_ar))*255
    sim_ar = sim_ar.astype(np.uint8)
    
    
    sim_im = Image.fromarray(sim_ar)
    
    sim_im.show()

    sim_im = sim_im.save("./Images/sim_im.png")
    return sim_ar_score



if __name__ == "__main__":
    #first image file name 
    first_image = sys.argv[1]
    
    #second image file name
    second_image = sys.argv[2]
    
    print('running')
    sim_ar_score = main(first_image, second_image)
    
    
    overall_similarity = np.mean(np.mean(np.abs(np.abs(sim_ar_score))))
    print('overall similarity: ', overall_similarity)
    
    data = {'score' : overall_similarity}
    with open('data.json', 'w') as outfile:
        json.dump(data, outfile)
    
    df = pd.DataFrame(sim_ar_score)
    df.to_excel('similarity_score.xlsx')
    print('done')
    