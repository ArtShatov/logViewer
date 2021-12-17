# Задача: Разработать страницу для просмотра логов

Требования:

Каждая запись в таблице с логами представляет из себя следующий набор обязательных полей:
ts - время создания записи
type - числовой тип записи, с возможными значениями от 1 до 10
message - текстовое описание события

Логи должны отображаться в виде таблицы с постраничной навигацией по 100 элементов на странице, возможностью сортировки по времени и фильтром по типу записи. Удаления логов из базы не предполагается, логи только пишутся и читаются.

Время отображения любой страницы не должно превышать 500мс. Backend должен быть написан на PHP. В качестве базы данных можно использовать одну из следующих РСУБД: MySQL | MariaDB | PostgreSQL.

По фронтенду никаких требований нет, достаточно простого html-table со ссылкой для сортировки, текстовым инпутом для фильтра, с кнопками "вперед-назад" и возможностью выбрать страницу руками
