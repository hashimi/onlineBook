<?php
/*
 * @author Reneesh T.K http://www.phpclasses.org/package/5360-PHP-Show-MySQL-query-results-split-in-pages-using-AJAX.html
 * Developed and Modified by: Jamshid Hashimi <jamshidhashimi@hotmail.com>
 * You can use it with out any worries...It is free for you..It will display the out put like:
 * First | Previous | 3 | 4 | 5 | 6 | 7| 8 | 9 | 10 | Next | Last
 * Page : 7  Of  10 . Total Records Found: 20
*/
class Pagination_class{
	var $anchors;
	var $total;
	function paginate($numrows,$starting,$recpage,$link,$div,$str)
	{
            $next           = $starting+$recpage;
            $var            = ((intval($numrows/$recpage))-1)*$recpage;
            $page_showing   = intval($starting/$recpage)+1;
            $total_page     = ceil($numrows/$recpage);

            if($numrows % $recpage != 0){
                    $last = ((intval($numrows/$recpage)))*$recpage;
            }else{
                    $last = ((intval($numrows/$recpage))-1)*$recpage;
            }
            $previous = $starting-$recpage;
            $anc = "<ul id='pagination-flickr'>";
            if($previous < 0){
                    $anc .= "<li class='previous-off'>First</li>";
                    $anc .= "<li class='previous-off'>Previous</li>";
            }else{
                    $anc .= "<li class='next'><a href='#' onclick=\"javascript:load_pagination('$link','$div','0','$str');\">First </a></li>";
                    $anc .= "<li class='next'><a href='#' onclick=\"javascript:load_pagination('$link','$div','$previous','$str');\">Previous </a></li>";
            }
		
            ################If you dont want the numbers just comment this block###############	
            $norepeat = 4;//no of pages showing in the left and right side of the current page in the anchors 
            $j = 1;
            $anch = "";
            for($i=$page_showing; $i>1; $i--){
                    $fpreviousPage = $i-1;
                    $page = ceil($fpreviousPage*$recpage)-$recpage;
                    $anch = "<li><a href='#' onclick=\"javascript:load_pagination('$link','$div','$page','$str');\">$fpreviousPage </a></li>".$anch;
                    if($j == $norepeat) break;
                    $j++;
            }
            $anc .= $anch;
            $anc .= "<li class='active'>".$page_showing."</li>";
            $j = 1;
            for($i=$page_showing; $i<$total_page; $i++){
                    $fnextPage = $i+1;
                    $page = ceil($fnextPage*$recpage)-$recpage;
                    $anc .= "<li><a href='#' onclick=\"javascript:load_pagination('$link','$div','$page','$str');\">$fnextPage</a></li>";
                    if($j==$norepeat) break;
                    $j++;
            }
            ############################################################
            if($next >= $numrows){
                    $anc .= "<li class='previous-off'>Next</li>";
                    $anc .= "<li class='previous-off'>Last</li>";
            }else{
                    $anc .= "<li class='next'><a href='#' onclick=\"javascript:load_pagination('$link','$div','$next','$str');\">Next </a></li>";
                    $anc .= "<li class='next'><a href='#' onclick=\"javascript:load_pagination('$link','$div','$last','$str');\">Last</a></li>";
            }
                    $anc .= "</ul>";
            $this->anchors = $anc;

            $this->total = "Page : $page_showing <i> Of  </i> $total_page . Total Records Found: $numrows";
    }
}