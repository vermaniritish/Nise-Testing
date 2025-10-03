<?php 
use App\Libraries\FileSystem;
// CHAGE THE LOGIN AS PER YOUR FILE TYPE AND HANDLE MLTIPLE OR SINGLE IMAGE CASE
if($file)
{

	$multiple = json_decode($file, true);
	
	$allFiles = $multiple && is_array($multiple) ? $multiple : ($file ? [$file] : null);
	
	if($allFiles)
	{
		
		foreach($allFiles as $oldFile)
		{
			
			$extension = pathinfo($oldFile, PATHINFO_EXTENSION);
			if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPEG', 'JPG', 'GIF']))
			{
				$sizesFiles = FileSystem::getAllSizeImages($oldFile);
				$imageSrc = isset($sizesFiles['small']) && $sizesFiles['small'] ? $sizesFiles['small'] : $oldFile;
				if($imageSrc)
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><img src="'.url($imageSrc).'"></div>';
				}
			}
			else if(in_array($extension, ['svg', 'SVG']))
			{
				$sizesFiles = FileSystem::getAllSizeImages($oldFile);
				$imageSrc = isset($sizesFiles['small']) && $sizesFiles['small'] ? $sizesFiles['small'] : $oldFile;
				if($imageSrc)
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><img src="'.url($imageSrc).'"></div>';
				}
			}
			elseif(in_array($extension, ['mp4', 'avi', 'flv','mov']))
			{
				if($oldFile)
				{
					echo '<div class="single-image single-video"><a href="javascript:;" class="fileRemover single-cross image video" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-relation-thumbnail="'.(isset($relationThumbnail) && $relationThumbnail ? $relationThumbnail : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'" data-thumbnail="'.(isset($thumbnail) && $thumbnail ? $thumbnail : null).'"><i class="fas fa-times"></i></a><video src="'.url($oldFile).'" controls></video></div>';
				}
			}
			elseif(in_array($extension, ['pdf', 'docx', 'doc','txt']))
			{
				// pr($extension); die;
				if($oldFile && $extension == 'pdf')
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><a target="_blank" href="'.url($oldFile).'"><img src="'.url("/assets/icon/pdf.png").'"></a></div>';
				}
				elseif($oldFile && $extension == 'docx')
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><a target="_blank" href="'.url($oldFile).'"><img src="'.url("/assets/icon/docx.png").'"></a></div>';
				}
				elseif($oldFile && $extension == 'doc')
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><a target="_blank" href="'.url($oldFile).'"><img src="'.url("/assets/icon/doc.jpg").'"></a></div>';
				}
				elseif($oldFile && $extension == 'txt')
				{
					echo '<div class="single-image"><a href="javascript:;" class="fileRemover single-cross image" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'" data-path="'.$oldFile.'"><i class="fas fa-times"></i></a><a target="_blank" href="'.url($oldFile).'"><img src="'.url("/assets/icon/text.png").'"></a></div>';
				}
			}
			else
			{
				
				if($oldFile)
				{
					$oldFileName = explode('/', $oldFile);
					$oldFileName = end($oldFileName);
					echo '<div class="single-file"><a href="'.url($oldFile).'" target="_blank"><i class="fas fa-file"></i>'.$oldFileName.'</a><a href="javascript:;" class="fileRemover single-cross file" data-path="'.$oldFile.'" data-relation="'.(isset($relationType) && $relationType ? $relationType : null).'" data-id="'.(isset($relationId) && $relationId ? $relationId : null).'"><i class="fas fa-times"></i></a></div>';
				}
			}
		}
	}
}
?>
