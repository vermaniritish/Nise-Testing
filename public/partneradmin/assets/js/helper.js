function checkFileExtension(filename) 
{
    return filename.substr((filename.lastIndexOf('.') +1));
}