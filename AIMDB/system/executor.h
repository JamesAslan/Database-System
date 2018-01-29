/**
 * @file    executor.h
 * @author  liugang(liugang@ict.ac.cn)
 * @version 0.1
 *
 * @section DESCRIPTION
 *  
 * definition of executor
 *
 */

#ifndef _EXECUTOR_H
#define _EXECUTOR_H

#include "catalog.h"
#include "mymemory.h"

/** aggrerate method. */
enum AggrerateMethod {
    NONE_AM = 0, /**< none */
    COUNT,       /**< count of rows */
    SUM,         /**< sum of data */
    AVG,         /**< average of data */
    MAX,         /**< maximum of data */
    MIN,         /**< minimum of data */
    MAX_AM
};

/** compare method. */
enum CompareMethod {
    NONE_CM = 0,
    LT,        /**< less than */
    LE,        /**< less than or equal to */
    EQ,        /**< equal to */
    NE,        /**< not equal than */
    GT,        /**< greater than */
    GE,        /**< greater than or equal to */
    LINK,      /**< join */
    MAX_CM
};

/** definition of request column. */
struct RequestColumn {
    char name[128];    /**< name of column */
    AggrerateMethod aggrerate_method;  /** aggrerate method, could be NONE_AM  */
};

/** definition of request table. */
struct RequestTable {
    char name[128];    /** name of table */
};

/** definition of compare condition. */
struct Condition {
    RequestColumn column;   /**< which column */
    CompareMethod compare;  /**< which method */
    char value[128];        /**< the value to compare with, if compare==LINK,value is another column's name; else it's the column's value*/
};

/** definition of conditions. */
struct Conditions {
    int condition_num;      /**< number of condition in use */
    Condition condition[4]; /**< support maximum 4 & conditions */
};

/** definition of selectquery.  */
class SelectQuery {
  public:
    int64_t database_id;           /**< database to execute */
    int select_number;             /**< number of column to select */
    RequestColumn select_column[4];/**< columns to select, maximum 4 */
    int from_number;               /**< number of tables to select from */
    RequestTable from_table[4];    /**< tables to select from, maximum 4 */
    Conditions where;              /**< where meets conditions, maximum 4 & conditions */
    int groupby_number;            /**< number of columns to groupby */
    RequestColumn groupby[4];      /**< columns to groupby */
    Conditions having;             /**< groupby conditions */
    int orderby_number;            /**< number of columns to orderby */
    RequestColumn orderby[4];      /**< columns to orderby */
};  // class SelectQuery

/** definition of result table.  */
class ResultTable {
  public:
    int column_number;       /**< columns number that a result row consist of */
    BasicType **column_type; /**< each column data type */
    char *buffer;         /**< pointer of buffer alloced from g_memory */
    int64_t buffer_size;  /**< size of buffer, power of 2 */
    int row_length;       /**< length per result row */
    int row_number;       /**< current usage of rows CURRENT NUMBER OF ROW*/
    int row_capicity;     /**< maximum capicity of rows according to buffer size and length of row  MAXIMUN OF ROW */
    int *offset;
    int offset_size;

    /**
     * init alloc memory and set initial value
     * @col_types array of column type pointers
     * @col_num   number of columns in this ResultTable
     * @param  capicity buffer_size, power of 2
     * @retval >0  success
     * @retval <=0  failure
     */
    int init(BasicType *col_types[],int col_num,int64_t capicity = 1024);
    /**
     * calculate the char pointer of data spcified by row and column id
     * you should set up column_type,then call init function
     * @param row    row id in result table
     * @param column column id in result table
     * @retval !=NULL pointer of a column
     * @retval ==NULL error
     */
    char* getRC(int row, int column);
    /**
     * write data to position row,column
     * @param row    row id in result table
     * @param column column id in result table
     * @data data pointer of a column
     * @retval !=NULL pointer of a column
     * @retval ==NULL error
     */
    int writeRC(int row, int column, void *data);
    /**
     * print result table, split by '\t', output a line per row 
     * @retval the number of rows printed
     */
    int print(void);
    /**
     * write to file with FILE *fp
     */
    int dump(FILE *fp);
    /**
     * free memory of this result table to g_memory
     */
    int shut(void);
};  // class ResultTable


/** definition of Operator.  */
class Operator {
    protected:
        RowTable *tabout; 	        /**< This is only for RPattern and getColumnRank */
        					        /**< We only need its skeleton: cols_name[], cols_id[] and col_num. */
        					        /**< record data inside is meaningless. */
        RowTable *tabin[4];         /**< tables input in each operation. */
        int64_t tabout_colnum = 0;	/**< the number of column in tabout. */
        ResultTable result;         /**< each operator got its own ResultTable(Buffer) except Scan Operator. */
        BasicType   **in_col_type;	/**< column types of input tables. */
	public:
        int64_t Ope_id = 0;	        /**< for DEBUG use. */
        /**
         * construction of Operator.
         */
        Operator(void) {}
        /**
         *  operator init
         *  @retval false for failure 
         *  @retval true  for success 
         */
		virtual bool	init    () = 0;	
        /**
         * get next record and put it in resulttable 
         * @param result buffer to store the record 
         * @retval false for failure 
         * @retval true  for success 
         */
		virtual	bool	getNext (ResultTable *result) = 0;
        /**
         * where this operator is end 
         * @retval false not end
         * @retval true  run end
         */
		virtual	bool	isEnd   () = 0;
        /**
         * close the operator and release memory
         * @retval false for failure 
         * @retval true  for success 
         */
        virtual bool    close   () = 0;
        /**
         * get the output result table of this Operator
         * @retval tabout 
         */
        RowTable *getTableOut   () { 
            return tabout; 
        }
};

/** definition of Scan operator. */
class Scan : public Operator {
    private:
        int64_t current_row;/**< row number has been scaned. */
        int64_t col_num;    /**< number of columns           */
	public:
        /**
         * Scan rowtable from tabin
         * @param tablename the tabin that this function will scan 
         */
        Scan(char *tablename);
        /**
         * init scan operator 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool	init	();
        /**
         * get next record of scan 
         * @param result the buffer to store result of scan 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    getNext (ResultTable *result);
        /**
         * judge where scan is end 
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd   ();
        /**
         * close scan and release memory
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    close   ();
};

/** definition of filter operaotr*/
class Filter : public Operator {
    private:
        Operator *prior_op;         /**< operator of prior operation.     */
        int64_t col_rank;           /**< which column need to be filtered.*/
        char value[128];            /**< const value                      */ 
        BasicType *value_type;      /**< column types of filter columns   */
        CompareMethod cmp_method;   /**< compare methods                  */
    public:
        /**
         * construction of filter Operator
         * @param op prior_op that needs to inherit
         * @param cond the filter conditions.
         */
        Filter(Operator *op, Condition *cond);
        /**
         * init operator 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    init    (); 
        /**
         * get next record 
         * @param result the buffer to store result. 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    getNext (ResultTable *result);
        /**
         * judge whether is end
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd   ();
        /**
         * close operator and release memory
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    close   ();
}; 

/** definition of hashjoin. */
class HashJoin : public Operator {
    private:
        Operator *op[2] = {NULL, NULL};    /**< prior operator from tow join table. */
        int op_num = 0;                    /**< number of join table                */
        int cond_num = 0;                  /**< number of join conditions           */ 
        int colB_row = 0;                  /**< the rownumber of table  B           */
        int col_num[2] = {0, 0};           /**< the clolumn numbers of two table    */
        int64_t colA_oid = -1;             /**< column A object  id                 */
        int64_t colB_oid = -1;             /**< column B object  id                 */
        int64_t colA_rank = -1;            /**< column A rank                       */
        int64_t colB_rank = -1;            /**< column B rank                       */
        ResultTable row_i[200000];         /**< result table to store temp result   */
        BasicType * value_type;            /**< result type of result               */
        HashIndex * hash_index = NULL;     /**< hash index of hash table            */
        HashTable * hash_table = NULL;     /**< hash tale to store data             */
        BasicType** colB_type;             /**< column types of table B             */
    public:
        /**
         * construction of HashJoin
         * @param op_num tables need to Join
         * @param op prior oprators
         * @param cond_num condition number of join 
         * @param join condtions
         */
        HashJoin(int op_num, Operator **op, int cond_num, Condition *cond);
        /**
         * init hashjoin.
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    init    ();
        /**
         * get next record of hash Join
         * @param result buffer to store result 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    getNext (ResultTable *result);
        /**
         * judge whether is end 
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd   ();
        /**
         * close operator and release memory.
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    close   (); 
};

/** definition of project   */
class Project : public Operator {
    private:
        Operator *prior_op;     /**< prior operators                      */
        int64_t col_tot;        /**< number of columns being projected.   */
        int64_t col_rank[4];    /**< rank sets of columns projected       */
    public:
        /**
         * construction of project 
         * @param op prior operators 
         * @param col_tot total columns projected 
         * @param cols_name columns name of projected column 
        */
        Project(Operator *op, int64_t col_tot, RequestColumn *cols_name);
        /** 
         * init of project 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    init    ();
        /**
         * get next record of operator 
         * @param result buffer to store result 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    getNext (ResultTable *result);
        /**
         * judge whether is end
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd   (); 
        /**
         * close operator and release memory.
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    close   ();
};

/** definiton of OrderBy   */
class OrderBy :public Operator {
    private:
        Operator *prior_op;          /**< prior Operator                    */ 
        int64_t index = 0;           /**< index that has been ordered       */
        int64_t col_num = 0;         /**< number of columns                 */
        int64_t record_size;         /**< size of each record               */
        int64_t row_length;          /**< length of each row                */
        BasicType *cmp_col_type[4];  /**< column types of compare conditons */
        int64_t cmp_col_rank[4];     /**< ranks of each compare condtions   */
        int64_t cmp_col_offset[4];   /**< offset of each compared columns   */
        int64_t orderbynum;          /**< number of order conditions        */
        ResultTable re;              /**< temp result table to store result */
    public:
        /**
         * construction of OrderBy
         * @param op prior operators 
         * @param Orderbynum number of condtions in order 
         * @param cols_name names of columns 
         */
        OrderBy(Operator * op, int64_t Orderbynum, RequestColumn *cols_name);
        /**
         * sort buffer 
         * @param buffer the begin of orderby address
         */
        void bubble_sort(char *buffer );
        /**
         * quick sort 
         * @param buffer the begin of orderby address
         * @param left left (low)side of order sequence
         * @param right right (high)side of order sequence 
         */
        void quick_sort(char *buffer ,int64_t left, int64_t right);
        /**
         * compare tow buffers 
         * @param l first buffer
         * @param r second buffer 
         * @retval 2 for >
         * @retval 1 for =
         * @retval 0 for <
         */
        int cmp(void*l,void*r);
        /** 
         * init of project 
         */
        bool    init();
        /**
         * get next record of operator 
         * @param result buffer to store result 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    getNext(ResultTable *result);
        /**
         * judge whether is end
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd() ;
        /**
         * close operator and release memory.
         * @retval false for failure 
         * @retval true  for success 
         */
        bool    close() ;
};

/** definition of GroupBy */
class GroupBy : public Operator {
    private:
        Operator *prior_op;                 /**< operator of prior oprators */
        int64_t row_size;                   /**< size of row                */
        int aggre_num = 0;                  /**< aggrerate number           */
        int non_aggre_num = 0;              /**< number of non aggrerate    */
        BasicType *aggre_type[4];           /**< type of each aggrerate     */
        BasicType *non_aggre_type[4];       /**< type of each non aggrerate */
        size_t aggre_off[4];                /**< aggrerate offset           */
        size_t non_aggre_off[4];            /**< non aggrerate method offset*/ 
        int aggre_index = 0;                /**< index has been group       */
        int non_aggre_index = 0;            /**< index of non aggrerated    */
        AggrerateMethod aggre_method[4];    /**< aggrerate methods          */
        ResultTable temp_one;               /**< buffer to store one result */
        ResultTable temp_result;            /**< buffer to store tmp result */ 
        int col_num = 0;                    /**< number of column           */
        int index = 0;                      /**< index of current           */
        
        /**
         * get hash from a string with length
         * @param str input a string 
         * @param length the length of string
         * @retval hash number
         */
        int64_t hash(char *str, int64_t length);
        /**
         * do aggregation on a column
         * @param method Aggregation method
         * @param probe_result the result of hashtable::probe
         * @param agg_i the index of aggregation
         * @retval false for failure 
         * @retval true  for success 
         */
        bool aggre(AggrerateMethod method, uint64_t probe_result, int agg_i);

    public:
        /**
         * construction of OrderBy
         * @param op prior operators 
         * @param groupby_num number of condtions to groupby 
         * @param req_col names of columns 
         */
        GroupBy(Operator *op, int groupby_num, RequestColumn req_col[4]);
        /** 
         * init of project 
         */
        bool    init();
        /**
         * get next record of operator 
         * @param result buffer to store result 
         * @retval false for failure 
         * @retval true  for success 
         */
        bool getNext(ResultTable *result);
        /**
         * judge whether is end
         * @retval false not end
         * @retval true  run end
         */
        bool    isEnd() ;
        /**
         * close operator and release memory.
         * @retval false for failure 
         * @retval true  for success 
         */ 
        bool    close();
};
class Executor {
  private:
    //SelectQuery *current_query = NULL;     /**< selectquery to iterately execute.     */
    Operator    *top_op = NULL;            /**< Top operator of the operator tree.    */
    BasicType   **result_type;             /**< Type of every column in result table. */
    int64_t     filter_tid[4];             /**< Table id of filter conditions.        */
    Condition   *join_cond[4];             /**< Conditions for join.                  */
    int64_t     count;                     /**< count records for debug uses          */
    int64_t     timesin;                   /**< count for enter func exec times       */
  public:
    /**
     * exec function.
     * @param  query to execute, if NULL, execute query at last time 
     * @result result table generated by an execution, store result in pattern defined by the result table
     * @retval >0  number of result rows stored in result
     * @retval <=0 no more result
     */
    virtual int exec(SelectQuery *query, ResultTable *result);
};
#endif
