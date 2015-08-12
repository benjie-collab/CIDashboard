<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id, $url='', $btns=array('edit', 'delete'))
{
    $CI= & get_instance();
    $html='<span class="actions">';
	if(in_array('edit',$btns))
    $html .= '<a class="m-5 edit-row-confirm" href="javascript:void(0)" data-url="' . base_url($url . '/edit/' . $id) .'">' . lang('edit_link') . '</a>';
	if(in_array('delete',$btns))
    $html .= '<a class="m-5 delete-row-confirm" href="javascript:void(0)" data-url="' . base_url($url . '/delete/' . $id) . '">' . lang('delete_link') . '</a>';
	if(in_array('view',$btns))
	$html .= '<a class="m-5 " href="' . base_url($url . '/view/' . $id) . '">' . lang('view_link') . '</a>';
    $html.='</span>';    
    return $html;
}



function user_status($id, $active=false)
{
    $CI   = & get_instance();	
	$html= '';	
	$html.=		((bool)$active)==true? 
				anchor("user/deactivate/".$id, 'active', array('data-toggle'=>'modal', 'data-target'=> '#modal-user')) : 
				anchor("user/activate/".$id, 'inactive', array());
	
    return $html;
}



