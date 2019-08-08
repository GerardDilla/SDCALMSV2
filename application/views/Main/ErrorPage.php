
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i class="fa <?php echo isset($this->data['Page_icon']) ? $this->data['Page_icon'] : ''; ?>"></i> <?php echo isset($this->data['Page_title']) ? $this->data['Page_title'] : ''; ?></h2>
    
        <div class="right-wrapper pull-right" style="padding-right:20px">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?php echo isset($this->data['Page_title']) ? $this->data['Page_title'] : ''; ?></span></li>
            </ol>
            <a class="sidebar-right-toggle"></a>
            
        </div>
    </header>
    <div id="particles-js"></div>
    <div class="row">
        <div class="col-md-12" style="background-color: rgba(255,255,255, 0.4); color: ccc;  font-weight: bold; z-index: 2; padding: 20px; padding-top: 100px; padding-bottom: 100px; text-align: center;">
            <div class="row">
                <div class="col-md-3">
                    <h1 style="font-size:600%"><i class="fa <?php echo isset($this->data['Page_icon']) ? $this->data['Page_icon'] : ''; ?>"></i></h2>
                </div>
                <div class="col-md-9" style="text-align:left">
                    <h2><?php echo isset($this->data['ErrorMessage']) ? $this->data['ErrorMessage'] : ''; ?></h2>
                </div>
            </div>
        </div>
    </div>
  
</section>







 
