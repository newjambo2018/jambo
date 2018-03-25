<div class="container">
    <div class="row">


        <div class="col-md-12">
            <div class="row">
                <div class="page-header col-xs-12">
                    <h4 style="font-size: 26px;">Ваша история заказов&nbsp;&nbsp;<i class="fas fa-history"></i></h4>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="col-sm-2 col-xs-12" style="margin-bottom: 10px;">
                    <label>Выбор по дате:</label>
                    <select>
                        <option>10.03.2018</option>
                        <option>16.03.2018</option>
                        <option>17.03.2018</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 col-sm-offset-6">
                    <div class="search_box col-xs-12">
                        <form role="search">
                            <div style="padding-left: 190px;">
                                <input type="text" class="form-control" placeholder="Поиск по названию">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <th><input type="checkbox" id="checkall"/></th>
                        <th class="name-history">Товар</th>
                        <th class="name-history">Название товара</th>
                        <th class="name-history">Стоимость товара</th>
                        <th class="name-history">Дата заказа</th>

                        <th class="name-history">Удалить</th>
                        </thead>
                        <tbody>

                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td><img href="/images/cart/3.jpg"></td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>1300грн</td>
                            <td>10.03.2018</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete" class="delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td><img href="/images/cart/3.jpg"></td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>1300грн</td>
                            <td>10.03.2018</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete" class="delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td><img href="/images/cart/3.jpg"></td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>1300грн</td>
                            <td>10.03.2018</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete" class="delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td><img href="/images/cart/3.jpg"></td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>1300грн</td>
                            <td>10.03.2018</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete" class="delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <td><input type="checkbox" class="checkthis"/></td>
                            <td><img href="/images/cart/3.jpg"></td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>1300грн</td>
                            <td>10.03.2018</td>
                            <td>
                                <p data-placement="top" data-toggle="tooltip" title="Delete" class="delete">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </p>
                            </td>
                        </tr>


                        </tbody>

                    </table>


                </div>
                <div style="text-align: center">
                    <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Удаления товара из истории</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Вы уверены что хотите удалить этот товар?</div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span>Да</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Нет</button>
                </div>
            </div>
            <!-- /.Модальный контент -->
        </div>
        <!-- /.Модальное окно -->
    </div>
</div>