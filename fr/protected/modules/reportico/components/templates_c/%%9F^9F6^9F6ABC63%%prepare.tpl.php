<?php /* Smarty version 2.6.26, created on 2013-12-19 07:11:08
         compiled from prepare.tpl */ ?>
<?php if (! $this->_tpl_vars['REPORTICO_AJAX_CALLED']): ?> 
<?php if (! $this->_tpl_vars['EMBEDDED_REPORT']): ?> 
<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE><?php echo $this->_tpl_vars['TITLE']; ?>
</TITLE>
<LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="<?php echo $this->_tpl_vars['STYLESHEET']; ?>
">
<?php echo $this->_tpl_vars['OUTPUT_ENCODING']; ?>

</HEAD>
<BODY class="swPrpBody">
<?php else: ?>
<LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="<?php echo $this->_tpl_vars['STYLESHEET']; ?>
">
<?php endif; ?>

<?php echo '
<!--[if IE]>
<style type="text/css">
    .swPrpTextField
    {
        width: 350px;
    }
</style>
<![endif]-->
'; ?>


<?php if ($this->_tpl_vars['AJAX_ENABLED']): ?> 
<?php if (! $this->_tpl_vars['REPORTICO_AJAX_PRELOADED']): ?>
<?php echo '
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/jquery.js"></script>
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/reportico.js"></script>
<!--LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="{$JSPATH}/ui/themes/base/jquery.ui.all.css"-->
'; ?>

<?php endif; ?>
<?php echo '
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/ui/i18n/jquery.ui.datepicker-'; ?>
<?php echo $this->_tpl_vars['AJAX_DATEPICKER_LANGUAGE']; ?>
<?php echo '.js"></script>
<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/jquery.jdMenu.js"></script>
<LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/jquery.jdMenu.css">
<script type="text/javascript">var reportico_datepicker_language = "'; ?>
<?php echo $this->_tpl_vars['AJAX_DATEPICKER_FORMAT']; ?>
<?php echo '";</script>
<script type="text/javascript">var reportico_this_script = "'; ?>
<?php echo $this->_tpl_vars['SCRIPT_SELF']; ?>
<?php echo '";</script>
<script type="text/javascript">var reportico_ajax_script = "'; ?>
<?php echo $this->_tpl_vars['REPORTICO_AJAX_RUNNER']; ?>
<?php echo '";</script>
<script type="text/javascript">var reportico_ajax_mode = "'; ?>
<?php echo $this->_tpl_vars['REPORTICO_AJAX_MODE']; ?>
<?php echo '";</script>
'; ?>

<LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="<?php echo $this->_tpl_vars['JSPATH']; ?>
/ui/themes/base/jquery.ui.all.css">
<?php endif; ?>
<?php endif; ?>
<div id="reportico_container">
<?php echo '<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/ui/i18n/jquery.ui.datepicker-'; ?>
<?php echo $this->_tpl_vars['AJAX_DATEPICKER_LANGUAGE']; ?>
<?php echo '.js"></script>'; ?>

<?php echo '<script type="text/javascript" src="'; ?>
<?php echo $this->_tpl_vars['JSPATH']; ?>
<?php echo '/jquery.jdMenu.js"></script>'; ?>

<LINK id="reportico_css" REL="stylesheet" TYPE="text/css" HREF="<?php echo $this->_tpl_vars['JSPATH']; ?>
/jquery.jdMenu.css">
<FORM class="swPrpForm" id="criteriaform" name="topmenu" method="POST" action="<?php echo $this->_tpl_vars['SCRIPT_SELF']; ?>
">
<h1 class="swTitle"><?php echo $this->_tpl_vars['TITLE']; ?>
</h1>
<input type="hidden" name="session_name" value="<?php echo $this->_tpl_vars['SESSION_ID']; ?>
" />
<?php if ($this->_tpl_vars['DROPDOWN_MENU_ITEMS']): ?>
<ul id="dropmenu" class="jd_menu" style="clear: none;float: left;width: 100%; ">
<?php unset($this->_sections['menu']);
$this->_sections['menu']['name'] = 'menu';
$this->_sections['menu']['loop'] = is_array($_loop=$this->_tpl_vars['DROPDOWN_MENU_ITEMS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['menu']['show'] = true;
$this->_sections['menu']['max'] = $this->_sections['menu']['loop'];
$this->_sections['menu']['step'] = 1;
$this->_sections['menu']['start'] = $this->_sections['menu']['step'] > 0 ? 0 : $this->_sections['menu']['loop']-1;
if ($this->_sections['menu']['show']) {
    $this->_sections['menu']['total'] = $this->_sections['menu']['loop'];
    if ($this->_sections['menu']['total'] == 0)
        $this->_sections['menu']['show'] = false;
} else
    $this->_sections['menu']['total'] = 0;
if ($this->_sections['menu']['show']):

            for ($this->_sections['menu']['index'] = $this->_sections['menu']['start'], $this->_sections['menu']['iteration'] = 1;
                 $this->_sections['menu']['iteration'] <= $this->_sections['menu']['total'];
                 $this->_sections['menu']['index'] += $this->_sections['menu']['step'], $this->_sections['menu']['iteration']++):
$this->_sections['menu']['rownum'] = $this->_sections['menu']['iteration'];
$this->_sections['menu']['index_prev'] = $this->_sections['menu']['index'] - $this->_sections['menu']['step'];
$this->_sections['menu']['index_next'] = $this->_sections['menu']['index'] + $this->_sections['menu']['step'];
$this->_sections['menu']['first']      = ($this->_sections['menu']['iteration'] == 1);
$this->_sections['menu']['last']       = ($this->_sections['menu']['iteration'] == $this->_sections['menu']['total']);
?>
<li style="margin-left: 20px; margin-top: 0px">
<a href="<?php echo $this->_tpl_vars['MAIN_MENU_URL']; ?>
&project=<?php echo $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['project']; ?>
"><?php echo $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['title']; ?>
</a>
<ul style="padding: 0px; margin: 0px">
<?php unset($this->_sections['menuitem']);
$this->_sections['menuitem']['name'] = 'menuitem';
$this->_sections['menuitem']['loop'] = is_array($_loop=$this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['menuitem']['show'] = true;
$this->_sections['menuitem']['max'] = $this->_sections['menuitem']['loop'];
$this->_sections['menuitem']['step'] = 1;
$this->_sections['menuitem']['start'] = $this->_sections['menuitem']['step'] > 0 ? 0 : $this->_sections['menuitem']['loop']-1;
if ($this->_sections['menuitem']['show']) {
    $this->_sections['menuitem']['total'] = $this->_sections['menuitem']['loop'];
    if ($this->_sections['menuitem']['total'] == 0)
        $this->_sections['menuitem']['show'] = false;
} else
    $this->_sections['menuitem']['total'] = 0;
if ($this->_sections['menuitem']['show']):

            for ($this->_sections['menuitem']['index'] = $this->_sections['menuitem']['start'], $this->_sections['menuitem']['iteration'] = 1;
                 $this->_sections['menuitem']['iteration'] <= $this->_sections['menuitem']['total'];
                 $this->_sections['menuitem']['index'] += $this->_sections['menuitem']['step'], $this->_sections['menuitem']['iteration']++):
$this->_sections['menuitem']['rownum'] = $this->_sections['menuitem']['iteration'];
$this->_sections['menuitem']['index_prev'] = $this->_sections['menuitem']['index'] - $this->_sections['menuitem']['step'];
$this->_sections['menuitem']['index_next'] = $this->_sections['menuitem']['index'] + $this->_sections['menuitem']['step'];
$this->_sections['menuitem']['first']      = ($this->_sections['menuitem']['iteration'] == 1);
$this->_sections['menuitem']['last']       = ($this->_sections['menuitem']['iteration'] == $this->_sections['menuitem']['total']);
?>
<?php if (isset ( $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['items'][$this->_sections['menuitem']['index']]['reportname'] )): ?>
<li ><a href="<?php echo $this->_tpl_vars['RUN_REPORT_URL']; ?>
&project=<?php echo $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['project']; ?>
&xmlin=<?php echo $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['items'][$this->_sections['menuitem']['index']]['reportfile']; ?>
"><?php echo $this->_tpl_vars['DROPDOWN_MENU_ITEMS'][$this->_sections['menu']['index']]['items'][$this->_sections['menuitem']['index']]['reportname']; ?>
</a></li>
<?php endif; ?>
<?php endfor; endif; ?>
</ul>
</li>
<?php endfor; endif; ?>
</ul>
<?php endif; ?>

<?php if ($this->_tpl_vars['SHOW_TOPMENU']): ?>
	<TABLE class="swPrpTopMenu">
		<TR>
			<TD style="width: 50%; text-align:left">
<?php if ($this->_tpl_vars['SHOW_ADMIN_BUTTON']): ?>
<?php if (strlen ( $this->_tpl_vars['ADMIN_MENU_URL'] ) > 0): ?> 
                <a class="swLinkMenu" href="<?php echo $this->_tpl_vars['ADMIN_MENU_URL']; ?>
"><?php echo $this->_tpl_vars['T_ADMIN_MENU']; ?>
</a>
<?php endif; ?>
<?php endif; ?>
<?php if (strlen ( $this->_tpl_vars['MAIN_MENU_URL'] ) > 0): ?> 
<?php if ($this->_tpl_vars['SHOW_PROJECT_MENU_BUTTON']): ?>
				<a class="swLinkMenu" href="<?php echo $this->_tpl_vars['MAIN_MENU_URL']; ?>
"><?php echo $this->_tpl_vars['T_PROJECT_MENU']; ?>
</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['SHOW_DESIGN_BUTTON']): ?>
                                &nbsp;<input class="swLinkMenu" type="submit" name="submit_design_mode" value="<?php echo $this->_tpl_vars['T_DESIGN_REPORT']; ?>
">
<?php endif; ?>
<?php if ($this->_tpl_vars['OUTPUT_SHOW_DEBUG']): ?>
<?php if ($this->_tpl_vars['SHOW_DESIGN_BUTTON']): ?>
			<TD style="width:15%; text-align: right; padding-right: 10px;" class="swPrpTopMenuCell">
				<?php echo $this->_tpl_vars['T_DEBUG_LEVEL']; ?>

				<SELECT name="debug_mode">';
					<OPTION <?php echo $this->_tpl_vars['DEBUG_NONE']; ?>
 label="None" value="0"><?php echo $this->_tpl_vars['T_DEBUG_NONE']; ?>
</OPTION>
					<OPTION <?php echo $this->_tpl_vars['DEBUG_LOW']; ?>
 label="Low" value="1"><?php echo $this->_tpl_vars['T_DEBUG_LOW']; ?>
</OPTION>
					<OPTION <?php echo $this->_tpl_vars['DEBUG_MEDIUM']; ?>
 label="Medium" value="2"><?php echo $this->_tpl_vars['T_DEBUG_MEDIUM']; ?>
</OPTION>
					<OPTION <?php echo $this->_tpl_vars['DEBUG_HIGH']; ?>
 label="High" value="3"><?php echo $this->_tpl_vars['T_DEBUG_HIGH']; ?>
</OPTION>
				</SELECT>
			</TD>
<?php endif; ?>
<?php endif; ?>

<?php endif; ?>
			</TD>
<?php if ($this->_tpl_vars['SHOW_LOGOUT']): ?>
			<TD style="width:15%; text-align: right; padding-right: 10px;" class="swPrpTopMenuCell">
				<input class="swLinkMenu" type="submit" name="logout" value="<?php echo $this->_tpl_vars['T_LOGOFF']; ?>
">
			</TD>
<?php endif; ?>
<?php if ($this->_tpl_vars['SHOW_LOGIN']): ?>
			<TD width="10%"></TD>
			<TD width="55%" align="left" class="swPrpTopMenuCell">
<?php if (strlen ( $this->_tpl_vars['PROJ_PASSWORD_ERROR'] ) > 0): ?>
                                <div style="color: #ff0000;"><?php echo $this->_tpl_vars['T_PASSWORD_ERROR']; ?>
</div>
<?php endif; ?>
				<?php echo $this->_tpl_vars['T_ENTER_PROJECT_PASSWORD']; ?>
<br><input type="password" name="project_password" value=""></div>
				<input class="swLinkMenu" type="submit" name="login" value="<?php echo $this->_tpl_vars['T_LOGIN']; ?>
">
			</TD>
<?php endif; ?>
		</TR>
	</TABLE>
<?php endif; ?>
<?php if ($this->_tpl_vars['SHOW_CRITERIA']): ?>
    <div style="display: none">
										&nbsp;
										<?php echo $this->_tpl_vars['T_OUTPUT']; ?>

											<INPUT type="radio" id="rpt_format_html" name="target_format" value="HTML" <?php echo $this->_tpl_vars['OUTPUT_TYPES'][0]; ?>
>HTML
											<INPUT type="radio" id="rpt_format_pdf" name="target_format" value="PDF" <?php echo $this->_tpl_vars['OUTPUT_TYPES'][1]; ?>
>PDF
											<INPUT type="radio" id="rpt_format_csv" name="target_format" value="CSV" <?php echo $this->_tpl_vars['OUTPUT_TYPES'][2]; ?>
>CSV
<?php if ($this->_tpl_vars['SHOW_DESIGN_BUTTON']): ?>
											<INPUT type="radio" id="rpt_format_xml" name="target_format" value="XML" <?php echo $this->_tpl_vars['OUTPUT_TYPES'][3]; ?>
>XML
											<INPUT type="radio" id="rpt_format_json" name="target_format" value="JSON" <?php echo $this->_tpl_vars['OUTPUT_TYPES'][4]; ?>
>JSON
<?php endif; ?>
   
    </div>
	<TABLE class="swPrpCritBox" id="critbody">
<?php if ($this->_tpl_vars['SHOW_OUTPUT']): ?>
        <TR>
            <td>
			<div style="width: 20%; padding-top: 15px;float: left;vertical-align: bottom;text-align: center">
                <b><?php echo $this->_tpl_vars['T_REPORT_STYLE']; ?>
</b>
                <INPUT type="radio" id="rpt_style_detail" name="target_style" value="TABLE" <?php echo $this->_tpl_vars['OUTPUT_STYLES'][0]; ?>
><?php echo $this->_tpl_vars['T_TABLE']; ?>

                <INPUT type="radio" id="rpt_style_form" name="target_style" value="FORM" <?php echo $this->_tpl_vars['OUTPUT_STYLES'][1]; ?>
><?php echo $this->_tpl_vars['T_FORM']; ?>

			</div>
			<div class="swPrpToolbarPane" style="width: 30%; float: left; vertical-align: bottom;text-align: right">
<?php if ($this->_tpl_vars['SHOW_DESIGN_BUTTON']): ?>
    				<input type="submit" class="prepareAjaxExecute swJSONBox" title="<?php echo $this->_tpl_vars['T_PRINT_JSON']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
    				<input type="submit" class="prepareAjaxExecute swXMLBox" style="margin-left: 20px" title="<?php echo $this->_tpl_vars['T_PRINT_XML']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
<?php endif; ?>
    				<input type="submit" class="prepareAjaxExecute swCSVBox" title="<?php echo $this->_tpl_vars['T_PRINT_CSV']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
    				<input type="submit" class="prepareAjaxExecute swPDFBox" title="<?php echo $this->_tpl_vars['T_PRINT_PDF']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
    				<input type="submit" class="prepareAjaxExecute swHTMLBox" title="<?php echo $this->_tpl_vars['T_PRINT_HTML']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
    				<input type="submit" class="prepareAjaxExecute swPrintBox" style="margin-right: 30px" title="<?php echo $this->_tpl_vars['T_PRINTABLE']; ?>
" id="prepareAjaxExecute" name="submitPrepare" value="">
			</div>
			<div style=" display: none; width: 50%; padding-top: 15px;float: left;vertical-align: bottom;text-align: center">
                                  <b><?php echo $this->_tpl_vars['T_SHOW']; ?>
</b>
				<INPUT type="checkbox" style="display:none" name="user_criteria_entered" value="1" checked="1">
				<INPUT type="checkbox" name="target_show_criteria" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWCRITERIA']; ?>
><?php echo $this->_tpl_vars['T_SHOW_CRITERIA']; ?>

				<INPUT type="checkbox" name="target_show_group_headers" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWGROUPHEADERS']; ?>
><?php echo $this->_tpl_vars['T_SHOW_GRPHEADERS']; ?>

				<INPUT type="checkbox" name="target_show_detail" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWDETAIL']; ?>
><?php echo $this->_tpl_vars['T_SHOW_DETAIL']; ?>

				<INPUT type="checkbox" name="target_show_group_trailers" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWGROUPTRAILERS']; ?>
><?php echo $this->_tpl_vars['T_SHOW_GRPTRAILERS']; ?>

				<INPUT type="checkbox" name="target_show_column_headers" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWCOLHEADERS']; ?>
><?php echo $this->_tpl_vars['T_SHOW_COLHEADERS']; ?>

<?php if ($this->_tpl_vars['OUTPUT_SHOW_SHOWGRAPH']): ?>
				<INPUT type="checkbox" name="target_show_graph" value="1" <?php echo $this->_tpl_vars['OUTPUT_SHOWGRAPH']; ?>
><?php echo $this->_tpl_vars['T_SHOW_GRAPH']; ?>
<BR>
<?php endif; ?>
			</div>
            </td>
		</TR>
<?php else: ?>
<?php endif; ?>
	</TABLE>
<div id="criteriabody">
	<TABLE class="swPrpCritBox" cellpadding="0">
<!---->
		<TR id="swPrpCriteriaBody">
			<TD class="swPrpCritEntry">
			<div id="swPrpSubmitPane">
    				<input type="submit" class="prepareAjaxExecute swHTMLGoBox" id="prepareAjaxExecute" name="submitPrepare" value="<?php echo $this->_tpl_vars['T_GO']; ?>
">
    				<input type="submit" class="reporticoSubmit" name="clearform" value="<?php echo $this->_tpl_vars['T_RESET']; ?>
">
                    &nbsp;
			</div>

                <TABLE class="swPrpCritEntryBox">
<?php if (isset ( $this->_tpl_vars['CRITERIA_ITEMS'] )): ?>
<?php unset($this->_sections['critno']);
$this->_sections['critno']['name'] = 'critno';
$this->_sections['critno']['loop'] = is_array($_loop=$this->_tpl_vars['CRITERIA_ITEMS']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['critno']['show'] = true;
$this->_sections['critno']['max'] = $this->_sections['critno']['loop'];
$this->_sections['critno']['step'] = 1;
$this->_sections['critno']['start'] = $this->_sections['critno']['step'] > 0 ? 0 : $this->_sections['critno']['loop']-1;
if ($this->_sections['critno']['show']) {
    $this->_sections['critno']['total'] = $this->_sections['critno']['loop'];
    if ($this->_sections['critno']['total'] == 0)
        $this->_sections['critno']['show'] = false;
} else
    $this->_sections['critno']['total'] = 0;
if ($this->_sections['critno']['show']):

            for ($this->_sections['critno']['index'] = $this->_sections['critno']['start'], $this->_sections['critno']['iteration'] = 1;
                 $this->_sections['critno']['iteration'] <= $this->_sections['critno']['total'];
                 $this->_sections['critno']['index'] += $this->_sections['critno']['step'], $this->_sections['critno']['iteration']++):
$this->_sections['critno']['rownum'] = $this->_sections['critno']['iteration'];
$this->_sections['critno']['index_prev'] = $this->_sections['critno']['index'] - $this->_sections['critno']['step'];
$this->_sections['critno']['index_next'] = $this->_sections['critno']['index'] + $this->_sections['critno']['step'];
$this->_sections['critno']['first']      = ($this->_sections['critno']['iteration'] == 1);
$this->_sections['critno']['last']       = ($this->_sections['critno']['iteration'] == $this->_sections['critno']['total']);
?>
                    <tr class="swPrpCritLine" id="criteria_<?php echo $this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['name']; ?>
">
                        <td class='swPrpCritTitle'>
                            <?php echo $this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['title']; ?>

                        </td>
                        <td class="swPrpCritSel">
                            <?php echo $this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['entry']; ?>

                        </td>
                        <td class="swPrpCritExpandSel">
<?php if ($this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['expand']): ?>
<?php if ($this->_tpl_vars['AJAX_ENABLED']): ?> 
                            <input class="swPrpCritExpandButton" id="reporticoPerformExpand" type="button" name="EXPAND_<?php echo $this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['name']; ?>
" value="<?php echo $this->_tpl_vars['T_EXPAND']; ?>
">
<?php else: ?>
                            <input class="swPrpCritExpandButton" type="submit" name="EXPAND_<?php echo $this->_tpl_vars['CRITERIA_ITEMS'][$this->_sections['critno']['index']]['name']; ?>
" value="<?php echo $this->_tpl_vars['T_EXPAND']; ?>
">
<?php endif; ?>
<?php endif; ?>
                        </td>
                    </TR>
<?php endfor; endif; ?>
<?php endif; ?>
                </TABLE>
<?php if (isset ( $this->_tpl_vars['CRITERIA_ITEMS'] )): ?>
<?php if (count ( $this->_tpl_vars['CRITERIA_ITEMS'] ) > 1): ?>
<div id="swPrpSubmitPane">
	<input type="submit" class="prepareAjaxExecute swHTMLGoBox" id="prepareAjaxExecute" name="submitPrepare" value="<?php echo $this->_tpl_vars['T_GO']; ?>
">
    <!--input type="submit" class="reporticoSubmit" name="clearform" value="<?php echo $this->_tpl_vars['T_RESET']; ?>
"-->
</div>
<?php endif; ?>
<?php endif; ?>
			</td>
			<TD class="swPrpExpand">
				<TABLE class="swPrpExpandBox">
					<TR class="swPrpExpandRow">
						<TD id="swPrpExpandCell" rowspan="0" valign="top">
<?php if (strlen ( $this->_tpl_vars['ERRORMSG'] ) > 0): ?>
            <TABLE class="swError">
                <TR>
                    <TD><?php echo $this->_tpl_vars['ERRORMSG']; ?>
</TD>
                </TR>
            </TABLE>
<?php endif; ?>
<?php if (strlen ( $this->_tpl_vars['STATUSMSG'] ) > 0): ?> 
			<TABLE class="swStatus">
				<TR>
					<TD><?php echo $this->_tpl_vars['STATUSMSG']; ?>
</TD>
				</TR>
			</TABLE>
<?php endif; ?>
<?php if (strlen ( $this->_tpl_vars['STATUSMSG'] ) == 0 && strlen ( $this->_tpl_vars['ERRORMSG'] ) == 0): ?>
<div style="float:right; ">
<?php if (strlen ( $this->_tpl_vars['MAIN_MENU_URL'] ) > 0): ?>
<!--a class="swLinkMenu" style="float:left;" href="<?php echo $this->_tpl_vars['MAIN_MENU_URL']; ?>
">&lt;&lt; Menu</a-->
<?php endif; ?>
</div>
<p>
<?php if ($this->_tpl_vars['SHOW_EXPANDED']): ?>
							<?php echo $this->_tpl_vars['T_SEARCH']; ?>
 <?php echo $this->_tpl_vars['EXPANDED_TITLE']; ?>
 :<br><input  type="text" name="expand_value" style="width: 50%" size="30" value="<?php echo $this->_tpl_vars['EXPANDED_SEARCH_VALUE']; ?>
"</input>
									<input id="reporticoPerformExpand" class="swPrpSubmit" type="submit" name="EXPANDSEARCH_<?php echo $this->_tpl_vars['EXPANDED_ITEM']; ?>
" value="Search"><br>

<?php echo $this->_tpl_vars['CONTENT']; ?>

							<br>
							<input class="swPrpSubmit" type="submit" name="EXPANDCLEAR_<?php echo $this->_tpl_vars['EXPANDED_ITEM']; ?>
" value="Clear">
							<input class="swPrpSubmit" type="submit" name="EXPANDSELECTALL_<?php echo $this->_tpl_vars['EXPANDED_ITEM']; ?>
" value="Select All">
							<input class="swPrpSubmit" type="submit" name="EXPANDOK_<?php echo $this->_tpl_vars['EXPANDED_ITEM']; ?>
" value="OK">
<?php endif; ?>
<?php if (! $this->_tpl_vars['SHOW_EXPANDED']): ?>
<?php if (! $this->_tpl_vars['REPORT_DESCRIPTION']): ?>
<?php echo $this->_tpl_vars['T_DEFAULT_REPORT_DESCRIPTION']; ?>

<?php else: ?>
						&nbsp;<br>
						<?php echo $this->_tpl_vars['REPORT_DESCRIPTION']; ?>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
			</TABLE>

<?php endif; ?>
</div>
			<!---->

</FORM>
<!--div class="smallbanner">Powered by <a href="http://www.reportico.org/" target="_blank">reportico <?php echo $this->_tpl_vars['REPORTICO_VERSION']; ?>
</a></div-->
</div>
<?php if (! $this->_tpl_vars['REPORTICO_AJAX_CALLED']): ?> 
<?php if (! $this->_tpl_vars['EMBEDDED_REPORT']): ?> 
</BODY>
</HTML>
<?php endif; ?>
<?php endif; ?>