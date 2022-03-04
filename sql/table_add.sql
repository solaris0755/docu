-- 테이블 목록
insert into erd.documents
SELECT 'table',TABLE_NAME, '', TABLE_COMMENT FROM information_schema.tables WHERE table_schema='jbbuller' AND table_type='BASE TABLE'
and table_name='_car_order_lists_countup_his'

-- 컬럼 목록
insert into erd.documents
SELECT 'column',COLUMN_NAME,TABLE_NAME,column_comment FROM information_schema.columns WHERE table_schema='jbbuller'
and table_name='_car_order_lists_countup_his';

